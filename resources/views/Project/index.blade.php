@extends('layouts.index')

@section('content')

<script>

    $(function () {
        
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('AdminProject.list') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'project_name', name: 'project_name'},
                {data: 'technology_name', name: 'technology_name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

    function checkboxchecked(x)
    {
        var getval = $(x).val();

        if($('input[type="checkbox"]').is(":checked"))
        {
            $(".btn-primary").show();
        }
        else
        {
            $(".btn-primary").hide();
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
                    $(".complete-project-btn").hide();
                    $('input[type="checkbox"]').prop("checked",false);
                }
            });
        });
    }

</script>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Project 
            <a href='adminAddProject' class="btn btn-info mb-3"> New </a>
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
            <center><button type="button"  class="edit btn btn-primary btn-sm m-1"  style="display:none"> Complete Project </button></center><br/><br/>

            <table class="table table-hover">
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
    </div>
</main>


@endsection