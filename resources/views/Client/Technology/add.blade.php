@extends('Client.layouts.master')

@section('content')

    <div class="pagetitle">
        <h1> Enter Technology </h1>
    </div>
        
    <div class="box-body">
        <h4 class="box-form-header"> Add Technology </h4>
        <form method="post" action="{{url('/')}}/AddTechnology"> 
            @csrf
            Technology Name <span class="error"> * </span>
            <input type='text' name='technm' class="input-tagspace" placeholder="Enter Technology Name" />
            @if($errors->any())
                <span class="input-tagspace" style="color:red"> {{$errors->first()}}</span>
            @endif
            <br/>
            <button type="button"  class="btn-cancel"> Cancel </button>
            <button type="submit" name="submit" class="btn-submit"> Submit </button>
        </form>
    </div>

@endsection