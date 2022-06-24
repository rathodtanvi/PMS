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
            @foreach(explode(',', $pro->technology_id) as $info) 
            @foreach($technology as $tech) 
                 @if($info == $tech->id)
                   [{{$tech->technology_name}}]
                 @endif
            @endforeach
     @endforeach   
           
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
           Days - {{$val}}<br>
          Duration - {{$value}}
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
           @foreach(explode(',', $pro->technology_id) as $info) 
                 @foreach($technology as $tech) 
                      @if($info == $tech->id)
                        [{{$tech->technology_name}}]
                      @endif
                 @endforeach
          @endforeach 
        </div>
        </td>
        @foreach ($a as $key => $value)
           @if($key == $pro->project_id)
            @foreach($b as $key=>$val)
            @if($key == $pro->project_id)

            @foreach ($a_data as $a_key => $a_value)
            @if($a_key == $pro->project_id)
             @foreach($b_data as $b_key=>$a_val)
             @if($b_key == $pro->project_id)
          <td>
           <div class="data_hr">Days - {{$val}}</div>         
          <div class="data"> Duration - {{$value}}</div>
          </td> 
                
          <td>
          Days - {{$a_val}} <br>
          Duration - {{$a_value}}
         </td>
       
      
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - {{$hr_arr}}</div>
          <div class="data">Duration - {{$sumTime_arr}}</div>
        </td>
      
      </tr>
      <tr>
        <td style="color:#FFF; background-color:#099">Total</td>
        <td style="color:#FFF; background-color:#099">
          <div class="data_hr">Days - {{$val}} </div>
          <div class="data">Duration -  {{$value}}</div>
        </td>
        <td style="color:#FFF; background-color:#099">
          Days -  {{$a_val}}<br>
          Duration -  {{$a_value}}
        </td>
       
        <td style="color:#FFF; background-color:#066">
          <div class="data_hr">Days - {{$hr_arr}} </div>
          <div class="data">Duration - {{$sumTime_arr}}</div>
        </td>
      
     
        @endif
        @endforeach
        @endif        
        @endforeach

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
  
   