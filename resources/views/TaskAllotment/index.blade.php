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
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Task Allotment
          <a class="btn btn-info"  href="{{route('TaskAllotment.create')}}" style="float:right">New</a> 
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
          <div id="taskid" style="display: none"></div>
          <div class="message"></div>
          <div class="modal-body">
             {{-- @for($i = 1; $i <= 5; $i++)
            <li class="fa fa-star-o change rating" id={{$i}}></li>
            @endfor  --}}
          <div>
                 @if(isset($task)|| isset($tk))
                    @foreach ($task as $tk)                        
                    @if(array_key_exists($tk->id,$rating))
                      @foreach ($tk->rating as $rate)
                      {{$rate->task_id}} 
                      {{$rate->task->id}} 
                 
                      @if($rate->user_id == Auth::user()->id)
                      @for($i = 1; $i <= 5; $i++)
                        @if ($i <= $rate->star_rated )
                        <li class="fa fa-star change rating-css" id={{$i}}></li>
                        @else
                        <li class="fa fa-star-o change rating" id={{$i}}></li>
                        @endif
                        @endfor
                        @endif
                        @endforeach
                    @else
                    @for($i = 1; $i <= 5; $i++)
                    <li class="fa fa-star-o change rating" id={{$i}}></li>
                    @endfor
                    @endif
                    @endforeach     
                  @endif  
           
            </div>    
          
         
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
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

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
</body>
@if (Auth::user()->roles_id != 3)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
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


</html>
@endsection