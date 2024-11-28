let submitMethod;

$(document).ready(function () {
    $("#example").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "guru-serverside", // URL untuk mengambil data
            type: "GET",
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "name", name: "name" },
            { data: "nip", name: "nip" },
            { data: "address", name: "address" },
            { data: "phone", name: "phone" },   
            { data: "email", name: "email" },   
            {
                data: "image",
                name: "image",
                render: function(data) {
                    return '<img src="' + data + '" alt="Image" style="width: 100px; height: auto;"/>'
                }
            },
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
    });
});

const modal = (e) => {

    submitMethod = "create";

    resetForm("#form");
    $("#modal").modal("show");
    $(".modalTitle").html('<i class="fa fa-plus"></i> Create');
    $(".btnSubmit").html('<i class="fa fa-save"></i> Save');
    $("#password").closest('.mb-3').show();
    resetValidation();
};

// create/save data
$("#form").on("submit", function (e) {
    e.preventDefault();
    startLoading();

    let url, method;
    url = "/panel/guru";
    method = "POST";

    const dataInput = new FormData(this);

    if (submitMethod == "edit") {
        url = "/panel/guru/" + $("#id").val();
        dataInput.append("_method", "PUT");
    }

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: method,
        url: url,
        data: dataInput,
        contentType: false,
        processData: false,
        success: function (response) {
            $("#modal").modal("hide");
            reloadTable();
            toastSuccess(response.message);
            resetValidation();
        },
        error: function (jqXHR, response) {
            console.log(response.message);
            toastError(jqXHR.responseText);
        },
    });
});

const editTeacher = (e) => {
    let id = e.getAttribute("data-id");

    startLoading();
    resetForm("#form");
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/panel/guru/" + id,
        success: function (response) {
            let parsedData = response.data;
            let parsedUser = response.user;

            $("#id").val(parsedData.uuid);
            $("#name").val(parsedData.name);
            $("#nip").val(parsedData.nip);
            $("#address").val(parsedData.address);
            $("#phone").val(parsedData.phone);
            $("#email").val(parsedData.email);

                        // Hide the password field if editing
                        $("#password").closest('.mb-3').hide();


            $("#modal").modal("show");
            $(".modalTitle").html('<i class="fa fa-edit"></i> Edit');
            $(".btnSubmit").html('<i class="fa fa-save"></i> Update');

            submitMethod = "edit";

            stopLoading();
        },
        error: function (jqXHR, response) {
            console.log(jqXHR.responseText);
            toastError(jqXHR.responseText);
        },
    });
};