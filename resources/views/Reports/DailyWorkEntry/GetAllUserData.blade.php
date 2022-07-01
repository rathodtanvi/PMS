

@foreach($users as $user)

<!-- Select2<div class="card">
    <div class="card-body"> --><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Technology</th>
                <th>Project</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Work Information</th>
                <th>Work Detail</th>
            </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach ($getalldata as $getdata)
                    @if ($getdata->user_id == $user->id)
                    <tr>
                        <td>
                            <?php echo $i++; ?>
                        </td>
                        <td>
                            
                            @foreach(explode(',', $getdata->technology_id) as $info) 
                                @foreach($gettech as $tech) 
                                    @if($info == $tech->id)
                                        {{$tech->technology_name}} 
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            {{$getdata->project->project_name}}
                        </td>
                        <td>
                            {{$getdata->user->name}}
                        </td>
                        <td>
                            {{$getdata->entry_date}}
                        </td>
                        <td> <b> Duration: </b> {{$getdata->entry_duration}} <br/>
                            <b> Type : </b> {{$getdata->work_type}} <br/>
                            
                            @if ($getdata->productive == '1')
                                <b> Productive : </b>  Yes
                                @else
                                <b> Productive : </b>  No
                            @endif
                        </td>
                        <td>
                            <b> Work Entry : </b> {{strip_tags($getdata->description)}}
                        </td>
                    </tr>
                    @endif
                @endforeach
                    
            </tbody>
        </table>

        <br/>
        <div class=" pr-3" style="color:#FFF; font-size:18px; border:1;width: 41%;float: right!important">
            <div class="table-responsive" width="100%" style="background-color:#066;">
                <div style="margin:10px;">
                <span> <b> Total Timing </b> </span><br/><br/>
                    Days : 
                    <?php $i=0; ?>
                    @foreach ($getalldata as $getdata)
                    
                        @if($getdata->user_id == $user->id)
                        <?php $i++; ?>
                                    
                        @endif 
                    
                    @endforeach
                    <?php echo $i; ?>
                <br/>

                Duration : <?php $times = []; ?>
                    
                    @foreach ($getalldata as $getdata)
                    
                        @if($getdata->user_id == $user->id)
                            <?php $times[] = $getdata->entry_duration.":0"; ?>  
                                    
                        @endif 
                    
                    @endforeach
                    <?php //print_r($times);
                        $seconds  = 0;
                        foreach ($times as $time) 
                        {
                            list($hour, $minute , $second) = explode(':', $time);
                            $seconds  += $hour * 3600;
                            $seconds  += $minute * 60;
                            $seconds  += $second ;
                        }
                        $hours = floor($seconds  / 3600);
                        $seconds -= $hours * 3600;

                        $minutes  = floor($seconds/60);
                        $seconds -= $minutes * 60;
                        echo sprintf('%02d Hours %02d Minutes', $hours, $minutes);
                    ?>

                </div>
            </div>
        </div>
    <!-- </div>
</div> -->


    
@endforeach

