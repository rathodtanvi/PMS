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
            ajax: "{{ route('Project.getdata') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'technology_id', name: 'technology_id'},
                {data: 'project_name', name: 'project_name'},  
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
                url: "{{ url('statuschange') }}",
                type: 'GET',
                datatype: 'JSON',
                data: {id : idval },
                success: function(res)
                {
                    tr.find(".actiondiv").html("<i class='fa fa-check-circle-o' style='font-size:36px;color:green;'></i> ");
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
            <a href="{{route('project.create')}}" class="btn btn-info mb-3"> New </a>
        </h1>
    </div>  
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Project</li>
        </ol>
    </nav>
    @if (session('status'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <center><button type="button"  class="btn btn-primary btn-sm m-1 completeproject"  style="display:none"> Complete Project </button></center>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>No</th>                     
                        <th>Technology Name</th>
                        <th>Project Name</th>
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