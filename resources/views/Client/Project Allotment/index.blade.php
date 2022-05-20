@extends('layouts.frontend.index')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<link rel="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ProjectAllotment.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'user_nm', name: 'user_nm'},
                {data: 'Project_Name', name: 'Project_Name'},
                {data: 'Technology_Name', name: 'Technology_Name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project 
            <a href='AddAllotment' class="new-btn"> New </a><br/><br/>
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

