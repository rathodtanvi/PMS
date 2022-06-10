@extends('layouts.index')
@section('content')

<script src="{{ asset('userpms.js') }}"></script>
<link href="{{ asset('rating.css') }}" rel="stylesheet">

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head> 
<body> 
  
  @if (Auth::user()->roles_id != 3)

  <script type="text/javascript">
  $(function () {

  var table = $('.yajra-datatable').DataTable({
    "sScrollX": "300%",
    "bScrollCollapse": true,
    "bAutoWidth": false,
    responsive: true,
        ajax: "{{ route('task_allotment_list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'employeename', name: 'employeename'},
            {data: 'project_name', name: 'project_name'},
            {data:'tl_id',name:'tl_id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'days_txt', name: 'days_txt'},
            {data: 'hours_txt', name: 'hours_txt'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  </script>

@else

  <script type="text/javascript">
  $(function () {

  var table = $('.yajra-datatable').DataTable({
    "sScrollX": "300%",
    "bScrollCollapse": true,
    "bAutoWidth": false,
    responsive: true,
        ajax: "{{ route('task_allotment_list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'project_name', name: 'project_name'},
            {data:'tl_id',name:'tl_id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'days_txt', name: 'days_txt'},
            {data: 'hours_txt', name: 'hours_txt'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  
  </script>
  @endif

    
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Task Allotment
          <a class="btn btn-info"  href="{{route('add_task')}}" style="float:right">New</a> 
      </h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Task Allotment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Task Rating</h5>
          </div>
          <div class="message"></div>
          <div class="modal-body">
            @for($i = 1; $i <= 5; $i++)
            <li class="fa fa-star-o change rating-css" id={{$i}}></li>
            @endfor
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- Table with stripped rows -->
              <table class="table  yajra-datatable ">
                  <thead>
                    <tr>
                        <th>No</th>
                        @if (Auth::user()->roles_id != 3)
                        <th>Employee Name</th>
                        @endif
                        <th>Project Name</th>
                        <th>Task Allocate By</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Estimate Days</th>
                        <th>Estimate Hours</th> 
                        <th>Manage</th> 
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              
              <!-- The Modal -->
              <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <div class="pagetitle"><h1> Review For Task <span class="tid" style="display:none"></span> </h1></div>
                      <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      
                        <textarea placeholder="Enter Review" id="reviewtxt" style="width:100%"></textarea>
                      
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary btn-sm m-1 sub-review"> Submit </button>
                    </div>
                    
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
  
</body>
</html>
@endsection

