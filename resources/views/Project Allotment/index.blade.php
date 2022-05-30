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
                {data: 'project_name', name: 'project_name'},
                {data: 'technology_name', name: 'technology_name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project Allotment
            <a href='adminAddAllotment' class="btn btn-info mb-3"> New </a>
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