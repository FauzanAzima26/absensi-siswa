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
            { data: "image", name: "image" },   
            {
                data: "action",
                name: "action",
                orderable: true,
                searchable: true,
            },
        ],
    });
});