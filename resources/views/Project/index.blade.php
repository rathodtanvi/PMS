@extends('layouts.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            "sScrollX": "300%",
            "bScrollCollapse": true,
            "bAutoWidth": false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('Project.list') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'project_name', name: 'project_name'},
                {data: 'technology.technology_name', name: 'technology.technology_name'},
                {data: 'teamleader', name: 'teamleader'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

    function checkboxchecked(x)
    {
        var getval = $(x).val();

        if($('input[type="checkbox"]').is(":checked"))
        {
            $(".completeproject").show();
        }
        else
        {
            $(".completeproject").hide();
        }
        $("body").on("click",".btn-primary",function()
        {
            var tr = $(x).closest("tr");
            var idval = $(x).val();
            
            $.ajax
            ({
                url: "{{url('/completeproject')}}",
                type: 'GET',
                datatype: 'JSON',
                data: {id : idval },
                success: function(res)
                {
                    tr.find(".actiondiv").html("<i class='bi bi-check-circle'></i>");
                    $(".completeproject").hide();
                    $('input[type="checkbox"]').prop("checked",false);
                }
            });
        });
    }

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project 
            <a href='AddProject' class="btn btn-info mb-3"> New </a>
        </h1>
    </div>  
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Project</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <center><button type="button"  class="btn btn-primary btn-sm m-1 completeproject"  style="display:none"> Complete Project </button></center>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>No</th>
                        <th>Project Name</th>
                        <th>Technology Name</th>
                        <th>Team Leader</th>
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