@extends('layouts.frontend.index')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1> Enter Technology </h1>
    </div>
        
    <div class="card">
        <div class="card-body">
        <h4 class="box-form-header"> Technology </h4>
        <form method="post" action="{{ url('update-technology/'.$edits->id) }}"> 
            @csrf
            Technology Name <span class="error"> * </span>
            <input type='text' name='technm' class="input-tagspace" placeholder="Enter Technology Name" value="{{$edits->Technology_Name}}"/>
            <br/>
            <button type="button"  class="btn-cancel"> Cancel </button>
            <button type="submit" name="submit" class="btn-submit"> Update </button>
        </form>
    </div>
    </div>

</main>
@endsection