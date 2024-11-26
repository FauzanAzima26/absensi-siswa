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

    $("#modal").modal("show");
    $(".modalTitle").html('<i class="fa fa-plus"></i> Create');
    $(".btnSubmit").html('<i class="fa fa-save"></i> Save');
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