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
            { data: "class_id", name: "class_id" },
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
    $("#password").closest(".mb-3").show();
    resetValidation();

     // Mengambil data kelas
     $.ajax({
        url: 'guru-getClass', // Endpoint untuk mengambil data kelas
        type: 'GET',
        success: function (data) {
            console.log(data); // Cek data yang diterima
            if (Array.isArray(data)) { // Pastikan data adalah array
                $('#class_id').empty(); // Kosongkan select box
                $('#class_id').append('<option value="" disabled selected>Pilih Class</option>');
                $.each(data, function (index, classItem) {
                    $('#class_id').append(`<option value="${classItem.id}">${classItem.name_kelas}</option>`);
                });
            } else {
                console.error('Data yang diterima bukan array:', data);
                // Tampilkan pesan kesalahan kepada pengguna
            }
        },
        error: function (error) {
            console.error('Error fetching classes:', error);
        }
    });
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

    // Ambil data kelas untuk mengisi select box
    $.ajax({
        url: 'guru-getClass', // Endpoint untuk mengambil data kelas
        type: 'GET',
        success: function (data) {
            if (Array.isArray(data)) {
                $('#class_id').empty(); // Kosongkan select box
                $('#class_id').append('<option value="" disabled selected>Pilih Class</option>');
                $.each(data, function (index, classItem) {
                    $('#class_id').append(`<option value="${classItem.id}">${classItem.name_kelas}</option>`);
                });
            } else {
                console.error('Data yang diterima bukan array:', data);
            }
        },
        error: function (error) {
            console.error('Error fetching classes:', error);
        }
    });

    // Ambil data guru berdasarkan ID
    $.ajax({
        type: "GET",
        url: "/panel/guru/" + id,
        success: function (response) {
            let parsedData = response.data;

            $("#id").val(parsedData.uuid);
            $("#name").val(parsedData.name);
            $("#nip").val(parsedData.nip);
            $("#address").val(parsedData.address);
            $("#phone").val(parsedData.phone);
            $("#email").val(parsedData.email);
            $("#class_id").val(parsedData.class_id); // Set nilai select box

            // Hide the password field if editing
            $("#password").closest(".mb-3").hide();

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

const destroyTeacher = (e) => {
    let id = e.getAttribute("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this teacher?",
        icon: "question",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            startLoading();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "DELETE",
                url: "/panel/guru/" + id,
                dataType: "json",
                success: function (response) {
                    stopLoading();
                    reloadTable();
                    toastSuccess(response.message);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }
    });
};

const detailTeacher = (e) => {
    let id = e.getAttribute("data-id");

    startLoading(); // Menampilkan indikator loading

    $.ajax({
        type: "GET",
        url: "/panel/guru/" + id, // Sesuaikan dengan endpoint API yang sesuai
        success: function (response) {
            let parsedData = response.data; // Ambil data guru dari response

            // Mengisi data ke dalam modal
            $("#viewName").val(parsedData.name);
            $("#viewNip").val(parsedData.nip);
            $("#viewAddress").val(parsedData.address);
            $("#viewPhone").val(parsedData.phone);
            $("#viewEmail").val(parsedData.email);

            // Menampilkan gambar
            const imageContainer = document.getElementById('viewImageContainer');
            imageContainer.innerHTML = ''; // Kosongkan sebelumnya
            if (parsedData.image) {
                const img = document.createElement('img');
                img.src =  '/storage/images/' + parsedData.image; // Ganti dengan path yang sesuai
                img.alt = 'Pas Foto';
                img.className = 'img-fluid'; // Tambahkan kelas untuk styling
                img.width = 200; // Atur lebar gambar
                img.height = 100; // Atur tinggi gambar (opsional)
                imageContainer.appendChild(img);
            }

            // Tampilkan modal
            $("#modalView").modal("show");
            $(".modalTitle").html('<i class="fa fa-eye"></i> Detail guru');
            stopLoading(); // Menghentikan indikator loading
        },
        error: function (jqXHR, response) {
            console.log(jqXHR.responseText);
            toastError(jqXHR.responseText); // Tampilkan pesan error
            stopLoading(); // Menghentikan indikator loading
        },
    });
};
