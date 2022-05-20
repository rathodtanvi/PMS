@extends('layouts.frontend.index')
@section('content')
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
          <li class="breadcrumb-item"><a href="{{url('userhome')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('report_project_total_hour')}}">Total Hour Spent Report</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Hour Spent Report</h5>
             
              <!-- Table with stripped rows -->
                <div class="col-4">    
                  <label class="col-form-label">Projetc</label>
                    <div> 
                      <select class="form-select">
                        <option selected>---select---</option>
                          <option value="1"></option>
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