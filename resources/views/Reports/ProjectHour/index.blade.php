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
     <div class="loading"></div>
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
    <div class="load"></div>
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
                      <select id="project"  name="project_id[]" class="form-control" multiple>
                        <option></option>
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
                      <button type="submit" class="btn btn-sm btn-info" id="getdata" style="float:left">
                        Get Data</button>
                    </div>
              </div>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>

          <!-- Card with header and footer -->
<div class="newdata"></div>
<div id="loader" class="lds-dual-ring hidden overlay"></div>
    </section>
  </main>
</body>
<script>
      $("#project").select2({
      placeholder: "Select a Project",
      allowClear: true,
  });
  $(document).ready(()=>{     
       $("#getdata").on("click",function(){

       if($('#project').val() == null)
        {
              $('.load').append(`<div class="alert alert-warning   alert-dismissible fade show" role="alert">
                 Please Select Project
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`);
        }
        else
        {
        $('.newdata').empty();
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
      success: function (response) { 
        $('.newdata').append(response);   
        }
        });
      }
       });
    
      });

</script>

</html>
@endsection