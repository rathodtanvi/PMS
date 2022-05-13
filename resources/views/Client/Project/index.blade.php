@extends('layouts.frontend.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('Project.list') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'Project_Name', name: 'Project_Name'},
                {data: 'Technology_Name', name: 'Technology_Name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });
    
    function checkboxchecked()
    {
        alert('hi');
    }
    </script>
<main id="main" class="main"> 
<div class="pagetitle">
    <h1>Project 
        <a href='AddProject' class="new-btn"> New </a>
    </h1>
</div>  
<div class="box-body">
    <table class="table">
        <thead>
            <tr>
                <th>Select</th>
                <th>No</th>
                <th>Project Name</th>
                <th>Technology Name</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</html>
</main>
@endsection