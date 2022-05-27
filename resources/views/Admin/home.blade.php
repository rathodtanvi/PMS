@extends('layouts.index')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card bg-aqua">
                  <div class="card-body">
                    <h5 class="card-title">Employee <span></span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa fa-user"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{$employee->count()}}</h6>
                      </div>    
                    </div>
                    <a href="{{url('')}}" class="mt-4">More Info</a>
                  </div>

                </div>
              </div>
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">ProjectOnGoing<span></span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-card-list"></i>
                      </div>
                      <div class="ps-3">
                        <h6>145</h6>
                      </div>
                    </div>
                    <a href="" class="mt-4">More Info</a>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Project Completed <span></span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                      </div>
                      <div class="ps-3">
                        <h6>145</h6>
                      </div>
                    </div>
                    <a href="" class="mt-4">More Info</a>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Client <span></span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                      </div>
                      <div class="ps-3">
                      <h6>145</h6>
                      </div>
                    </div>
                    <a href="" class="mt-4">More Info</a>
                  </div>
                </div>
              </div>
              <!-- End Sales Card -->
              
            </div>
           <div class="row">
             <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Attendance And Work Duration Report Of Sat, May 14, 2022</h5>
                  <!-- Table with stripped rows -->
                  <table class="table  yajra-datatable ">
                      <thead>
                        <tr>
                            <th>Sr.NO</th>
                            <th>Employee</th>
                            <th>Attendance Duration</th>
                            <th>Work Duration</th>
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
          </div>
          <!-- End Left side columns -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
          <link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
          <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
           <script type="text/javascript">
           $(function () {
          
            var table = $('.yajra-datatable').DataTable({
              responsive: true,
                  ajax: "{{ route('employee_list') }}",
                  columns: [ 
                      {data: 'id', name: 'id'},     
                      {data:'name',name:'name'},
                      {data: 'attendance_duration', name: 'attendance_duration'},
                      {data:'work_duration',name:'work_duration'},       
                  ]
              });
            });
          
          </script>
          <link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
          <!-- Right side columns -->
          <div class="col-lg-4  col-md-4">

            <!-- Recent Activity -->
       
              <div class="card bg-info text-white">
               <div class="card-body">
                 Attendance And Work Duration
                </div>
              </div>
              <div class="card bg-primary text-white">
              <div class="card-body">Daily WorkEntry</div>
              </div>
              <div class="card bg-success text-white">
                <div class="card-body">Project Total Hour</div>
              </div>
           
              <div class="card bg-warning text-white">
                <div class="card-body">project Summary</div>
              </div>
           
              <div class="card bg-danger text-white">
                <div class="card-body">Employee Summary</div>
              </div>
              <div class="card bg-secondary text-white">
                <div class="card-body">Leave</div>
              </div>
           <!-- End Recent Activity -->
          </div><!-- End Right side columns -->

        </div>


      </section> 

  </main>
@endsection