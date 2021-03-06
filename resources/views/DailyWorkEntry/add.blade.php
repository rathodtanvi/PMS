@extends('layouts.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Work Entry</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{url('DailyWorkEntry')}}">Daily work entry</a></li>
          <li class="breadcrumb-item">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <div class="p-2">
        <div class="col-lg-12 col-sm-12 col-sm-12">
          <div class="card p-2">
            <div class="card-body">
              <!-- General Form Elements -->
              <form method="Post" action="{{ route('DailyWorkEntry.store') }}"  id="dailyworkentryadd">
                @csrf
              <div class="row mb-3">
                <div class="col-4">
                        <label class="col-form-label">Project Name</label>
                        <div> 
                        <select class="form-select" aria-label="Default select example" name="project_id">
                        <option disabled selected value>---select---</option>
                        @foreach ($project as $item)
                        <option value="{{$item->project_id}}">{{$item->project->project_name}}</option>
                        @endforeach
                      </select>
                      @error('project_id')
                      <span style="color:red"> {{$message }} </span>
                    @enderror
                    </div>
                </div>
                <div class="col-4">
                <label class="col-form-label">Date</label>
                    <div class="col">
                      <input type="date" class="form-control" name="entry_date" value="{{date('Y-m-d', time())}}">
                    </div>
                  </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <div class="row">
                    <div class="col-6"> <label class="col-form-label">Hours</label>
                        <div class="">
                            <input type="number" class="form-control"  name="entry_duration_hours" >
                          </div></div>
                    <div class="col-6"> <label class="col-form-label">Minutes</label>
                        <div class="">
                            <input type="number" class="form-control"  name="entry_duration_minutes">
                          </div></div>
                    </div>
                </div>
                <div class="col-4">
                    <label class="col-form-label">Productive</label>
                    <div> 
                    <select class="form-select" aria-label="Default select example" name="productive">
                    <option value="1">Productive</option>
                    <option value="2">Non Productive</option>
                  </select>
                </div>
            </div> <div class="col-4">
                <label class="col-form-label">Work type</label>
                <div> 
                <select class="form-select" aria-label="Default select example" name="work_type">
                <option selected>New</option>
                <option value="1">Client Issue</option>
                <option value="2">Client Change</option>
                <option value="3">Bug Fixing</option>
              </select>
                </div>
              </div>
           </div>
                <div class="row mt-3 pb-2">
                  <div class="col-12 container" >
                  <div> <label for="inputPassword" class="col-sm-2 col-form-label" >Description</label></div>
                      <textarea  class="form-control textarea ckeditor"  name="description" id="description"></textarea>   
                </div>
                @error('description')
                <span style="color:red"> {{$message }} </span>
                @enderror 
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

