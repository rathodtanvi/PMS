@if(Auth::user()->roles_id == 1)
    
@foreach($projectname->unique('project_id')  as $pro)  
<div class="card" id="data">
    <div class="card-header text-white project_name" style="background-color: #00AA9E;">{{$pro->project->project_name}}</div>
    <div class="card-body">
 <table class="table">
    <thead>
      <tr>
          <th>Employee</th>
          <th>Productive</th>
          <th>Unproductive</th>
          <th style="color:#FFF; background-color:#099">Total</th>
      </tr>
        @foreach($info_data as $key => $value) 
          @if($key == $pro->project_id)
         @foreach(array_unique($value) as $val=>$data)
        <tr>
        <td><div><b>Employee :  </b> {{$data}}</div>
          <b>Technology:</b>
           <div class="tech_name">   
            {{$pro->technology->technology_name}}  
       </div>
        </td>
        {{-- @foreach ($a as $key => $value)
         @if($key == $pro->project_id)
         @foreach($b as $key=>$val)
         @if($key == $pro->project_id) --}}
        <td>
           <div class="data_hr">Days -  0</div>         
          <div class="data"> Duration -0 Hours 0 Minutes </div>
        </td>
        <td>
          Days - 0 <br>
          Duration - 0 Hours 0 Minutes
        </td>
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - 0</div>
          <div class="data">Duration -  0 Hours 0 Minutes</div>
        </td>
      </tr>
      {{-- @endif
      @endforeach
      @endif
      @endforeach --}}
      @endforeach
      @endif
       @endforeach
       @foreach ($a as $key => $value)
       @if($key == $pro->project_id)
       @foreach($b as $key=>$val)
       @if($key == $pro->project_id)
      <tr>
        <td style="color:#FFF; background-color:#099">Total</td>
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - {{$val}} </div>
          <div class="data">Duration -  {{$value}}</div>
        </td>
        <td style="color:#FFF; background-color:#099">
          Days - 0 <br>
          Duration - 0 Hours 0 Minutes
        </td>
        <td style="color:#FFF; background-color:#066">
          <div class="data_hr">Days - {{$val}} </div>
          <div class="data">Duration - {{$value}}</div>
        </td>
      </tr>  
      @endif
      @endforeach
      @endif
      @endforeach
    </thead>
  </table> 
</div></div><div>
 @endforeach

@else

@foreach($projectname->unique('project_id') as $pro)  
<div class="card" id="data">
    <div class="card-header text-white project_name" style="background-color: #00AA9E;">{{$pro->project->project_name}}</div>
    <div class="card-body">
 <table class="table">
    <thead>
      <tr>
          <th>Employee</th>
          <th>Productive</th>
          <th>Unproductive</th>
          <th style="color:#FFF; background-color:#099">Total</th>
      </tr>
      <tr>
        <td><div><b>Employee :  </b>{{$pro->user->name}}</div>
          <b>Technology:</b> 
          <div class="tech_name">
            {{$pro->technology->technology_name}} 
             {{-- @foreach(explode(',', $pro->technology_id) as $info) 
             @php $data=App\Models\Technology::where('id',$info)->pluck('technology_name')->toarray() @endphp
              @foreach($data as $tname)
                [{{$tname}}]
              @endforeach
          @endforeach  --}}
        </div>
        </td>
        @foreach ($a as $key => $value)
           @if($key == $pro->project_id)
            @foreach($b as $key=>$val)
            @if($key == $pro->project_id)
          <td>
           <div class="data_hr">Days - {{$val}}</div>         
          <div class="data"> Duration - {{$value}}</div>
        </td>
        <td>
          Days - 0 <br>
          Duration - 0 Hours 0 Minutes
        </td>
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - {{$val}}</div>
          <div class="data">Duration - {{$value}}</div>
        </td>
      </tr>
      <tr>
        <td style="color:#FFF; background-color:#099">Total</td>
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - {{$val}} </div>
          <div class="data">Duration -  {{$value}}</div>
        </td>
        <td style="color:#FFF; background-color:#099">
          Days - 0 <br>
          Duration - 0 Hours 0 Minutes
        </td>
        <td style="color:#FFF; background-color:#066">
          <div class="data_hr">Days - {{$val}} </div>
          <div class="data">Duration - {{$value}}</div>
        </td>
        @endif
        @endforeach
        @endif        
        @endforeach
      </tr>  
    </thead>
  </table> 
</div></div><div>
    @endforeach
   @endif 
  
   