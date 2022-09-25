
function province() {
    $("#province").change(function () {
        $("#district").html("<option selected> Choose District</option>");
        $.ajax({
            url: $("#routeDistrict").val() + "/" + $(this).val(),
            type: "GET",
            success: function (response) {
                response = $.parseJSON(response);
                if (response.status == 200) {
                    data = response.data;
                    $.each(data, function (key, value) {
                        $($.parseHTML("<option>" + value._name_district + "</option>")).attr("value", value.id).appendTo("#district");
                    })
                }
            }
        })
    })
}


function district() {
    $("#district").change(function () {
        $("#ward").html("<option selected> Choose District</option>");
        $.ajax({
            url: $("#routeWard").val() + "/" + $(this).val(),
            type: "GET",
            success: function (response) {
                response = $.parseJSON(response);
                if (response.status == 200) {
                    data = response.data;
                    $.each(data, function (key, value) {
                        $($.parseHTML("<option>" + value._name_ward + "</option>")).attr("value", value.id).appendTo("#ward");
                    })
                }
            }
        })
    })
}

function admin() {
    $("#ward").change(function () {
        $("#manager").html("");
        $.ajax({
            url: $("#routeShowAdmin").val() + "/" + $(this).val(),
            type: "GET",
            success: function (response) {
                response = $.parseJSON(response);
                if (response.status == 200) {
                    data = response.data;
                    $.each(data, function (key, value) {
                        $($.parseHTML("<option>" + value.fullName + "</option>")).attr("value", value.id).appendTo("#manager");
                    })
                }
                if (response.status == 412) {
                    $($.parseHTML("<option>" + response.data + "</option>")).appendTo("#manager");
                }
            }
        })
    })
}