
@foreach ($users as $user)

    <div class="card" id="data_table">
        <div class="card-header text-white usernm" style="background-color: #00AA9E;">{{$user->name}}</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Attendance Timing</th>
                    <th>Attendance Duration</th>
                    <th>Work Duration</th>
                </tr>
                </thead>
                <tbody>

            @foreach($datas as $info)
                    <tr>
                {{-- No --}}
                    <td>{{$user->id}}</td>
                {{-- Date --}}
                    <td>{{$info->format('l, F d,Y')}}</td>     
                {{-- Attendance Timing   --}}                                           
                    <td>
                        @foreach($attendance as $att)
                        @if(($user->id == $att->user_id && $info->format('Y-m-d')==$att->attendance_date))
                          {{$att->in_entry}}-{{$att->out_entry}}<br>
                        @endif
                        @if($info->format('l') == 'Saturday' || $info->format('l') == 'Sunday' )
                        <div style='color:orange'> Holiday </div>@break
                         {{-- @elseif (($user->id != $att->user_id &&  $att->attendance_date !=$info->format('Y-m-d')))
                         <div style='color:red' class="ab"> Absent </div>  --}}
                         @endif
                        @endforeach
                       </td> 
                {{-- Attendance Duration    --}}
                    <td>
                      
                        @foreach($attendance as $att)
                        
                        @foreach($atten_data as $key=>$value)
                         {{-- {{dd($key);}} --}}
                        @endforeach

                        @if($user->id == $att->user_id && $info->format('Y-m-d')==$att->attendance_date )
                            @if($att->out_entry != Null)
                             
                          
                           @else
                           <div class="badge bg-danger" style="font-size:15px;padding:7px;">No OUT</div>
                           @endif
                         @endif
                         @if($info->format('l') == 'Saturday' || $info->format('l') == 'Sunday' )
                         <div style='color:orange'> Holiday </div>@break
                          {{-- @elseif ($user->id != $att->user_id &&  $att->attendance_date !=$info->format('Y-m-d') )
                          <div style='color:red' class="ab"> Absent </div>  --}}
                          @endif
                        @endforeach 
                    </td>

                {{-- Work Duration --}}
                    <td>
                        @foreach($attendance as $att)
                        @if($user->id == $att->user_id && $info->format('Y-m-d')==$att->attendance_date )
                            @if($att->out_entry != Null)
                               @foreach ($getwork as $work)
                                  @if($user->id == $work->user_id  && $info->format('Y-m-d')==$work->entry_date)
                                   {{$work->entry_duration}}
                                
                                   @endif
                               @endforeach @break
                           @else
                           <div class="badge bg-danger" style="font-size:15px;padding:7px;">00:00</div>
                           @endif
                         @endif
                         @if($info->format('l') == 'Saturday' || $info->format('l') == 'Sunday' )
                        <div style='color:orange'> Holiday </div>@break
                         {{-- @elseif ($user->id != $att->user_id &&  $att->attendance_date !=$info->format('Y-m-d') )
                         <div style='color:red' class="ab"> Absent </div>  --}}
                         @endif
                        @endforeach   
                    </td>
                <tr>
            @endforeach 
                
                </tbody>
            </table>
        </div>
        <div class="card-footer  text-black">
            <div class="row">
            <div class="col-4">
                    <div class="row">
                    <div class="col-10">Required Attendance Hours</div>
                    <div class="col-2 badge bg-warning text-black AHours" style="font-size: 15px;">8</div>
                    </div>
            </div>
            <div class="col-4">
                <div class="row">
                <div class="col-10">Actual Attendance Hours</div>
                <div class="col-2 badge bg-danger ActualHours" style="font-size: 15px;">00:00</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                <div class="col-10">Work Duration Hours</div>
                <div class="col-2 badge bg-secondary text-white WorkHour" style="font-size: 15px;">00:00</div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Required Attendance Days</div>
                <div class="col-2 badge bg-warning text-black ADays" style="font-size: 15px;">1</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Actual Attendance Days</div>
                <div class="col-2 badge bg-danger ActualDay" style="font-size: 15px;">0</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row pt-2">
                <div class="col-10">Work Duration Days</div>
                <div class="col-2 badge bg-secondary text-white WorkDay" style="font-size: 15px;">0</div>
                </div>
            </div>
            </div>

        </div>
    </div>

 @endforeach 
