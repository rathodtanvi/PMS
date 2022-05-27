@extends('layouts.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('AdminProjectAllotment.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'user.name', name: 'user.name'},
                {data: 'Project_Name', name: 'Project_Name'},
                {data: 'Technology_Name', name: 'Technology_Name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project Allotment
            <a href='adminAddAllotment' class="new-btn"> New </a><br/><br/>
        </h1>
    </div>  
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Project Name</th>
                        <th>Technology Name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</main>


@endsection