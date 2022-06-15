@extends('layouts.index')
@section('content')
<!-- Select2  link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!DOCTYPE html>
<html>
<head>
    <title>Total Hour Spent Report</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Total Hour Spent Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('report_project_total_hour')}}">Total Hour Spent Report</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title --> 
    <div  id="select_project"></div>
   
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
                <div class="col-4">    
                  <label class="col-form-label">Project</label>
                    <div> 
                      <select id="project" name="project_id[]" class="form-control" multiple>
                        <option></option>
                          {{-- @forelse ($projects as $project)
                          <option value="{{$project->id}}">{{$project->project->project_name}}</option>     
                          @empty
                          <option></option>
                          @endforelse  --}}
                        @if(isset($projects))
                        @if(Auth::user()->roles_id == 1)
                        @foreach ($projects as $project)
                        <option value="{{$project->id}}" >{{$project->project_name}}</option>
                        @endforeach 
                        @else
                        @foreach ($projects as $project)
                        <option value="{{$project->project_id}}">{{$project->project->project_name}}</option>
                        @endforeach
                        @endif
                        @endif
                      </select>
                    </div>
                  </div>
              <div class="col-4">    
                <label class="col-form-label">From Date</label>
                  <div> 
                    <input type="date" class="form-control date_start" name="date_start" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                  </div>
                </div>
                <div class="col-4">    
                    <label class="col-form-label">To Date</label>
                      <div> 
                        <input type="date" class="form-control date_end" name="date_end" value="{{date('Y-m-d', time())}}" >
                      </div>
                </div>
                <div class="col-4">    
                    <div class="pt-3"> 
                      <button type="submit" class="btn btn-sm btn-info" id="getdata" style="float:left">Get Data</button>
                    </div>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
          <!-- Card with header and footer -->
<div class="card" id="data" style="display: none">
  <div class="card-header text-white project_name" style="background-color: #00AA9E;"></div>
  <div class="card-body">
    <!-- Table with stripped rows -->
    <table class="table">
      <thead>
        <tr>
            <th>Employee</th>
            <th>Productive</th>
            <th>Unproductive</th>
            <th style="color:#FFF; background-color:#099">Total</th>
        </tr>
        @if(isset($employee))
        @foreach ($employee as $emp)
        <tr>
          <td><b>Employee :  </b>{{$emp->name}}<br>
            <b>Techonogy:  </b> {{$project->technology->technology_name}}
            {{-- technology->technology_name --}}
          </td>
          <td >
             Days - 1 <br>          
            <div class="data">Duration - 0 Hours 0 Minutes</div>
          </td>
          <td>
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td style="color:#FFF; background-color:#099">
            Days - 1 <br>
            <div class="data">Duration - 0 Hours 0 Minutes</div>
          </td>
        </tr>
        @endforeach
        @endif
        <tr>
          <td style="color:#FFF; background-color:#099">Total</td>
          <td style="color:#FFF; background-color:#099">
            Days - 1 <br>
            <div class="data">Duration - 0 Hours 0 Minutes</div>
          </td>
          <td style="color:#FFF; background-color:#099">
            Days - 0 <br>
            Duration - 0 Hours 0 Minutes
          </td>
          <td style="color:#FFF; background-color:#066">
            Days - 1 <br>
            <div class="data">Duration - 0 Hours 0 Minutes</div>
          </td>
        </tr>
      
    </thead>
    <tbody>
    </tbody>
  </table>


  <!-- End Table with stripped rows -->
  </div>
</div><!-- End Card with header and footer -->
    </section>

  </main>
</body>
<script>
      $("#project").select2({
      placeholder: "Select a Project",
      allowClear: true
  });
  $(document).ready(()=>{
      $("#getdata").on("click",function(){
      $project=$('#project').val();  
      if($project == null)
      {
        // $("#select_project").html("<div class='alert alert-primary alert-dismissible fade show'>Please Select Project</div>");
        //    window.setTimeout(function(){location.reload()},5000)
        location.reload();
      }
      else
      {
        $('#data').show();
      }
      $date=$(".date_start").val();
      $date_end=$('.date_end').val();
      $project=$('#project').val();
      $.ajax({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },  
      type: "Post",
      url: "total_hour",
      data:{
        'date':$date,
        'date_end':$date_end,
        'project':$project,
        _token: $('meta[name="csrf-token"]').attr('content'),
      },
      dataType: "JSON",
      success: function (response) { 
        if(response.success == true)
        {
          $('.data').html('Duration - '+response.dailyworks);
          $('.project_name').html(response.project_id);
          console.log(response.project_id.project.project_name);
        }
      }
    });
  });
});
</script>

</html>
@endsection