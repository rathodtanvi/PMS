@extends('layouts.index')
@section('content')
<script src="{{ asset('userpms.js') }}"></script>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Task Allotment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('task_allotment')}}">Task Allotment</a></li>
          <li class="breadcrumb-item">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="p-3">
        <div class="col-lg-12 col-sm-12 col-sm-12">

          <div class="card p-2">
            <div class="card-body">


              <!-- General Form Elements -->
              <form method="post" action="{{route('enter_task')}}">
                @csrf
              <div class="row mb-3">
             
               @if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3)
                <div class="col-4">
                  <label class="col-form-label">Project Name</label>
                  <div> 
                  <select class="form-select project_tl" aria-label="Default select example" name="project_id">
                  <option disabled selected value>---select---</option>
                  @foreach ($project as $item)
                  <option value="{{$item->id}}">{{$item->project->project_name}}</option>
                  @endforeach 
                </select>
              </div>
            </div>
               @else
               <div class="col-4">
                <label class="col-form-label">Project Name</label>
                <div> 
                <select class="form-select projectname" aria-label="Default select example" name="project_id">
                <option disabled selected value>---select---</option>
                @foreach ($allproject as $item)
                <option value="{{$item->id}}">{{$item->project_name}}</option>
                @endforeach 
              </select>
            </div>
          </div>
               @endif

               @if(Auth::user()->roles_id == 1)
               <div class="col-4">
                      <label class="col-form-label">Employee Name</label>
                      <div> 
                      <select class="form-select empname" aria-label="Default select example" name="emp_name">
                      <option  disabled selected value>---select---</option>
                       {{-- @foreach ($emp as $em)                 
                        <option value="{{$em->id }}"> {{$em->name}}</option>
                      @endforeach --}}
                    </select>
                  </div>
              </div> 
             @endif
               @if(Auth::user()->roles_id ==2)
                <div class="col-4">
                       <label class="col-form-label">Employee Name</label>
                       <div> 
                       <select class="form-select emp_tl" aria-label="Default select example" name="emp_name">
                       <option  disabled selected value>---select---</option>
                        {{-- @foreach ($employee as $emp)
                       <option value="{{$emp->id }}{{ $emp->id == Auth::id()  ? 'selected' : '' }}"> {{$emp->name}}</option>
                       @endforeach --}}
                     </select>
                   </div>
               </div> 
              @endif
                <div class="col-4">
                <label class="col-form-label">Title</label>
                    <div class="col">
                      <input type="text" class="form-control" name="title"  placeholder="Enter Title">
                    </div>
                  </div>
               </div>
           <div class="row mt-3">
                <div class="col-4">
                  <label class="col-form-label">Select This</label>
                  <div class="col">     
                    <input type="radio"  name="entry" class="rd1" value="days" checked>
                    <label class="col-form-label pr-3">Days</label>
                    <input type="radio"  name="entry" class="rd2" value="hours">
                    <label class="col-form-label">Hours</label>
                  </div>
                </div>
             
                <div class="col-4" id="days">
                    <label class="col-form-label">Days</label>
                    <div> 
                      <input type="number" class="form-control" name="days_txt"  placeholder="Enter Days" >
                  </div>
               </div>
               <div class="col-4" id="hours" style="display:none;">
                <label class="col-form-label">Hours</label>
                <div> 
                  <input type="number" class="form-control" name="hours_txt"  placeholder="Enter Hours">
                 </div>
               </div>
              </div>
                <div class="row mt-3 pb-2">
                  <div class="col-12">
                  <div> <label for="inputPassword" class="col-sm-2 col-form-label">Description</label></div>
                      <textarea  class="form-control textarea ckeditor"  name="description"></textarea>   
                </div>
                <div class="row mt-5">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

