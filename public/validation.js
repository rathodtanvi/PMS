$(document).ready(function() {
    $("#techForm").validate({
        rules: {
            technology_name: "required",
        },
        messages: {
            technology_name: "Technology Name is required",
        }
    });


    $("#projectForm").validate({
        
        rules: {
            "technology_name[]": "required",
            project_name: "required",
        },
        messages: {
            "technology_name[]": "Technology Name is required",
            project_name: "Project Name is required",
        },
        errorPlacement: function(error, element) {
            //for name attribute
            if (element.attr("name") == "technology_name[]" )
            {
                error.appendTo($(".technm"));
            }
            else if(element.attr("name") == "project_name" )
            {
                error.appendTo($(".projectnm"));
            }
        }
        
    });
        

    $("#pAllotmentForm").validate({
        rules: {
            unm: "required",
            projectnm: "required",
            "technology_id[]": "required",
        },
        messages: {
            unm: "Employee Name is required",
            projectnm: "Project Name is required",
            "technology_id[]": "Technology Name is required",
        },
        errorPlacement: function(error, element) {
            //for name attribute
            if(element.attr("name") == "unm")
            {
                error.appendTo($(".empnm"));
            }
            else if(element.attr("name") == "projectnm" )
            {
                error.appendTo($(".pnm"));
            }
            else if(element.attr("name") == "technology_id[]" )
            {
                error.appendTo($(".technm"));
            }
        }
    });

});
