
@foreach ($users_data as $user)
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
                    @php $count=1; @endphp
                    @foreach($users_attendance as $key=>$value) 
                    @foreach($value as $val=>$val_data)
                       @if($key == $user->id)
                       <tr> 
                        {{-- No --}}
                        <td>@php echo $count; $count++; @endphp</td>
                          {{-- Date --}}
                         <td>{{$val}}</td>
                        {{-- Attendance Timing --}}
                         <td>@foreach($atten_result as $r_key=>$r_value)
                              @foreach($r_value as $r_val=>$rr)
                              @if($r_key == $user->id)
                                 @if($r_val == $val)
                                    @foreach($rr as $time=>$t_time) 
                                      @if($t_time == "Holiday")
                                      <div style='color:orange'> Holiday </div>
                                      @elseif($t_time == "Absent")
                                      <div style='color:red'> Absent </div>
                                      @else
                                        {{$time}}-{{$t_time}} <br>
                                      @endif
                                    @endforeach  
                                 @endif
                               @endif
                               @endforeach
                            @endforeach
                         </td>
                         {{--Attendance Duration --}}
                        
                         <td>
                            @if($val_data == "Holiday")
                            <div style='color:orange'> Holiday </div>
                            @elseif($val_data == "Absent")
                            <div style='color:red'> Absent </div>
                             @else
                             {{$val_data}}
                            @endif 
                        </td>
                          {{-- work Duration --}}
                         <td>
                            @foreach($daily_work_result as $work=>$duration)
                               @foreach($duration as $dur=>$work_data) 
                                @if($work == $user->id)
                                @if($dur == $val)
                                  @foreach($work_data as $f_time)
                                    @if($f_time == "Holiday")
                                    <div style='color:orange'> Holiday </div>
                                    @elseif($f_time == "Absent")
                                    <div style='color:red'> Absent </div>
                                     @else
                                     {{$f_time}}
                                    @endif 
                                 @endforeach
                                @endif
                             @endif 
                             @endforeach
                            @endforeach
                         </td>
                       </tr>
                        @endif
                     @endforeach
                    @endforeach
                 
                </tbody>
            </table>
        </div>
        <div class="card-footer  text-black">
            <div class="row">
            <div class="col-4">
                    <div class="row">
                    <div class="col-10">Required Attendance Hours</div>
                    <div class="col-2 badge bg-warning text-black AHours" style="font-size: 15px;">{{$countday_h}}</div>
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
