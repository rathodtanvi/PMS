
@extends('layouts.index')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>


    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Daily Work Entry Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item">DailyWorkEntry</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- Table with stripped rows -->
              <div class="col-4">    
                <label class="col-form-label">Project comp/InComp</label>
                  <div> 
                    <select class="form-select selectitem proj_status" name="proj_status">
                      <option></option>
                        <option value="1">Both</option>
                        <option value="2">Complete</option>
                        <option value="3">InComplete</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">    
                  <label class="col-form-label">Project</label>
                    <div> 
                      <select id="projectnm" name="projectnm" class="form-select selectitem projectnm" >
                          <option></option>
                          <option value="all">All</option>
                      </select>
                    </div>
                  </div>
                  @if(Auth::user()->roles_id != '1')
                  <div class="col-4">    
                    <label class="col-form-label">Techology</label>
                      <div> 
                        <select class="form-select selectitem technm" name="technm" id="technm" multiple>
                          <option></option>
                        </select>
                      </div>
                    </div>
                    @else
                    <div class="col-4">    
                      <label class="col-form-label">Employee</label>
                        <div> 
                          <select class="form-select selectitem usernm" name="usernm" id="usernm" multiple>
                            <option></option>
                            <option value="all"> All </option>
                            @foreach ($users as $user)
                              <option value="{{$user->id}}"> {{$user->name}} </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      @endif
                    <div class="col-4">    
                      <label class="col-form-label">From Date</label>
                        <div> 
                          <input type="date" class="form-control fromdate" name="date_start" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                        </div>
                      </div>
                        <div class="col-4">    
                          <label class="col-form-label">To Date</label>
                            <div> 
                              <input type="date" class="form-control todate" name="date_end" value="{{date('Y-m-d', time())}}" >
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
      
      <div class="datas card card-body"> 
      
        <div class="col-6">
          <button class="btn btn-sm btn-outline-dark exportbtn" value="CSV">CSV</button>
          <button class="btn btn-sm btn-outline-dark exportbtn" value="Excel">Excel</button>
          <button class="btn btn-sm btn-outline-dark exportbtn" value="PDF">PDF</button>
          <button class="btn btn-sm btn-outline-dark exportbtn" value="Print">Print</button>
        </div><br/>

        <div class="userdata"> </div>
        
      </div>
      
      <div class="card show-data" style="display:none">
        <div class="card-body">
          
          {{-- <div class="col-6">
            <button class="btn btn-sm btn-outline-dark exportbtn" value="CSV">CSV</button>
            <button class="btn btn-sm btn-outline-dark exportbtn" value="Excel">Excel</button>
            <button class="btn btn-sm btn-outline-dark exportbtn" value="PDF">PDF</button>
            <button class="btn btn-sm btn-outline-dark exportbtn" value="Print">Print</button>
          </div><br/> --}}

        <table class="table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Technology</th>
                <th>Project</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Work Information</th>
                <th>Work Detail</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
        <br/>
        <div class=" pr-3" style="color:#FFF; font-size:18px; border:1;width: 41%;float: right!important">
            <div class="table-responsive" width="100%" style="background-color:#066;">
              <div style="margin:10px;">
                <span> <b> Total Timing </b> </span><br/><br/>
                    Days : <span class="totdays"> </span><br/>
                    Duration :  <span class="totduration"> </span>
              </div>
            </div>
        </div>
      
    </section>
    
    

  </main>

  <!-- Select2  link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!-- yajra links -->
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


  <script type="text/javascript">
    
    $(".selectitem").select2({
      placeholder: "--select--",
      allowClear: true
    });

    function itemDataTable(pnm , tnm , unm ,fdate ,tdate)
    {
      if(typeof(unm) === "undefined")
      {
        $('.show-data').show();
        var dataTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            
            "destroy": true,
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "{{ route('report_dailyworklist') }}",
                type: 'get',
                data: {pnm , tnm ,fdate ,tdate},
            },
            
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'technology', name: 'technology'},
                {data: 'project', name: 'project'},
                {data: 'employee', name: 'employee'},
                {data: 'date', name: 'date'},
                {data: 'work_information', name: 'work_information'}, 
                {data: 'work_detail', name: 'work_detail'}, 
            ],
            buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
        });
      }
      else
      {
        
        $('.show-data').show();
        var dataTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            "destroy": true,
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            
            ajax: {
                url: "{{ route('report_dailyworklist') }}",
                type: 'get',
                data: {pnm , tnm , unm ,fdate ,tdate},
            },
            
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'technology', name: 'technology'},
                {data: 'project', name: 'project'},
                {data: 'employee', name: 'employee'},
                {data: 'date', name: 'date'},
                {data: 'work_information', name: 'work_information'}, 
                {data: 'work_detail', name: 'work_detail'}, 
            ]
        });
      }
    }

    function getTotal(pnm , tnm , unm ,fdate ,tdate)
    {
      $.ajax
        ({
            url: "{{ route('report_dailyworktotal') }}",
            type: "GET",
            datatype: 'JSON',
            data: {pname : pnm , tname : tnm , unm : unm ,fdate : fdate ,tdate : tdate},
            success: function(res)
            {
              $responseData = JSON.parse(res);
              $(".totdays").html($responseData.totDays);
              $(".totduration").html($responseData.entry_duration);
            }
        });
    }

  $(document).ready(function(){
      $('#getdata').click(function()
      {
        var pnm = $('.projectnm').val();
        var tnm = $('.technm').val();
        var unm = $('.usernm').val();
        var fdate = $('.fromdate').val();
        var tdate = $('.todate').val();
        
        if(unm == 'all')
        {
          $.ajax
              ({
                  url: "{{url('get_alluser')}}",
                  type: "GET",
                  data: {unm : unm ,fdate : fdate ,tdate : tdate },
                  success: function(response)
                  {
                    $(".userdata").html(response);
                  }
              });
        }
        else
        {
          
          itemDataTable(pnm , tnm , unm ,fdate ,tdate)
          getTotal(pnm , tnm , unm ,fdate ,tdate)
        }

      });
  });

    $(document).ready(function(){
      $('select[name="proj_status"]').on('change',function(){
          var pstatus = $(this).val();
          
          if (pstatus) 
          {
              $.ajax
              ({
                  url: "{{url('getproject')}}",
                  type: "GET",
                  dataType: "json",
                  data: {pname : pstatus },
                  success: function(res)
                  {
                      $('select[id="projectnm"]').html("<option> --select-- </option>");
                      $.each(res,function(Index,value)
                      {
                          
                          $('select[id="projectnm"]').append("<option value='"+ value.id +"'>"+value.project_name +"</option>");
                      });
                  }
              });
          }
          else 
          {
              $('select[id="projectnm"]').empty();
          }
      });
      
});

$(document).ready(function(){
      $('select[name="projectnm"]').on('change',function(){
          var pname = $(this).val();
          
          if (pname) 
          {
              $.ajax
              ({
                  url: "{{url('get_technology')}}",
                  type: "GET",
                  datatype: 'JSON',
                  data: {pname : pname },
                  success: function(res)
                  {
                      $('select[id="technm"]').empty();
                      $('select[id="usernm"]').empty();

                      $responseData = JSON.parse(res);
                      if($responseData.currentuser == 'Admin')
                      {
                        $('select[id="technm"]').append($responseData.tech_nm );
                        
                      }
                      else
                      {
                        $('select[id="usernm"]').append($responseData.empnm );
                      }
                      
                  }
              });
          }
          else 
          {
              $('select[id="technm"]').empty();
              $('select[id="usernm"]').empty();
          }
      });
      
});

  $(document).ready(function()
  {
    $('.exportbtn').click(function()
    {
      alert('hello');
        var pnm = $('.projectnm').val();
        var tnm = $('.technm').val();
        var unm = $('.usernm').val();
        var fdate = $('.fromdate').val();
        var tdate = $('.todate').val();

        $.ajax
        ({
            url: "{{url('pdf-download')}}",
            type: "GET",
            //datatype: 'JSON',
            data: {unm : unm ,fdate : fdate ,tdate : tdate},
            success: function(response)
            {
              
            }
        });
    });
  });


  </script>

@endsection