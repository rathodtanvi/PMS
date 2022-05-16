@extends('layouts.frontend.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('Technology.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'Technology_Name', name: 'Technology_Name'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
        
    });
    
    </script>

<main id="main" class="main"> 

    <div class="pagetitle">
        <h1>Technology 
            <a href='AddTechnology' class="new-btn"> New </a><br/><br/>
        </h1>
    </div>  
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail</h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
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