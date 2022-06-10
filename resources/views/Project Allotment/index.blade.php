@extends('layouts.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            "sScrollX": "300%",
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            ajax: "{{ route('ProjectAllotment.getdata') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'user.name', name: 'user.name'},
                {data: 'project.project_name', name: 'project.project_name'},
                {data: 'technology_id', name: 'technology_id'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project Allotment
            <a href='{{route('projectAllotement.create')}}' class="btn btn-info mb-3"> New </a>
        </h1>
    </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Project Allotment</li>
        </ol>
    </nav>  
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