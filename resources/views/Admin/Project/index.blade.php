@extends('layouts.backend.index')

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
                {data: 'Project_Name', name: 'Project_Name'},
                {data: 'Technology_Name', name: 'Technology_Name'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });
        
    });

    function checkboxchecked(x)
    {
        var getval = $(x).val();

        if($('input[type="checkbox"]').is(":checked"))
        {
            $(".complete-project-btn").show();
        }
        else
        {
            $(".complete-project-btn").hide();
        }
        $("body").on("click",".complete-project-btn",function()
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
            <a href='adminAddProject' class="new-btn"> New </a><br/><br/>
        </h1>
    </div>  
    
    <div class="card">
        <div class="card-body">
            <center><button type="button"  class="complete-project-btn" style="display:none"> Complete Project </button></center><br/><br/>

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