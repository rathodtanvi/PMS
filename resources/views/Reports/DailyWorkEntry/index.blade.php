@extends('layouts.backend.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Daily Work Entry Report</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
 
    <main id="main" class="main"> 
    <div class="pagetitle">
      <h1>Daily Work Entry Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('admin_report_daily_work_entry')}}">DailyWorkEntry</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Daily Work Entry Report</h5>
             
              <!-- Table with stripped rows -->
              <div class="col-4">    
                <label class="col-form-label">Projetc comp/InComp</label>
                  <div> 
                    <select class="form-select">
                      <option selected>---select---</option>
                        <option value="1">Both</option>
                        <option value="2">Complete</option>
                        <option value="3">InComplete</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">    
                  <label class="col-form-label">Projetc</label>
                    <div> 
                      <select class="form-select">
                        <option selected>---select---</option>
                          <option value="1">All</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">    
                    <label class="col-form-label">Techology</label>
                      <div> 
                        <select class="form-select">
                          <option selected>---select---</option>
                        </select>
                      </div>
                    </div>
              <div class="col-4">    
                <label class="col-form-label">From Date</label>
                  <div> 
                   <input type="date" class="form-control" name="date_start" value="{{ date("Y-m-d", strtotime( '-1 days' ) )}}">
                  </div>
                </div>
                 <div class="col-4">    
                    <label class="col-form-label">To Date</label>
                      <div> 
                       <input type="date" class="form-control" name="date_end" value="{{date('Y-m-d', time())}}" >
                      </div>
                 </div>
                 <div class="col-4">    
                    <div class="pt-3"> 
                     <button type="submit" class="btn btn-sm btn-info">Get Data</button>
                    </div>
               </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
   
    </section>

  </main>
</body>
</html>
@endsection