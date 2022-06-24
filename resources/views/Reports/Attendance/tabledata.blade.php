
@if (Auth::user()->roles_id == '3')
    <script>

        var dataTable = $('.table').DataTable({
            processing: true,
            serverSide: true,
            "destroy": true,
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            
            ajax: {
                url: "{{ route('report_attendancelist') }}",
                type: 'get',
                //data: {empnm ,fdate ,tdate},
            },
            
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'Attendance_Date', name: 'Attendance_Date'},
                {data: 'mergeColumn', name: 'mergeColumn'},
                {data: 'attendance_duration', name: 'attendance_duration'},
                {data: 'work_duration', name: 'work_duration'},
            ]
        });

    </script>
@endif

{{-- @foreach ($users as $user) --}}
    
    <div class="card" id="data">
        <div class="card-header text-white usernm" style="background-color: #00AA9E;"> {{Auth::user()->name}}</div>
        <div class="card-body">
            
            @if (Auth::user()->roles_id == '1')
            
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
                    
                </tbody>
            </table>
            @else
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Attendance Timing</th>
                    <th>Attendance Duration</th>
                </tr>
                </thead>
                <tbody >
                
                </tbody>
            </table>

            @endif
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

{{-- @endforeach --}}
