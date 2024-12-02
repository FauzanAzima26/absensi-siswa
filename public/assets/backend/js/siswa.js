let submit_method;

const deleteSiswa = (e) => {
    let uuid = e.getAttribute('data-uuid'); // Ambil UUID dari tombol
    console.log("UUID to delete:", uuid); // Debug UUID

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `/siswa/${uuid}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log("Response:", response);
                    Swal.fire({
                        title: "Deleted!",
                        text: response.message,
                        icon: "success",
                        timer: 2500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error("XHR:", xhr);
                    console.error("Status:", status);
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Failed!",
                        text: xhr.responseJSON ? xhr.responseJSON.message : "Your data has not been deleted.",
                        icon: "error"
                    });
                }
            });
        }
    });
};

document.addEventListener('DOMContentLoaded', function () {
    // Menampilkan pesan sukses
    if (sessionStorage.getItem('success')) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: sessionStorage.getItem('success'),
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.reload();
        });
        sessionStorage.removeItem('success');
    }

    // Menampilkan pesan error
    if (sessionStorage.getItem('error')) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: sessionStorage.getItem('error'),
            timer: 2000,
            showConfirmButton: false
        });
        sessionStorage.removeItem('error');
    }

    // Menampilkan pesan error dari validasi
    if (sessionStorage.getItem('validationErrors')) {
        const errors = JSON.parse(sessionStorage.getItem('validationErrors'));
        let errorList = '<ul>';
        errors.forEach(error => {
            errorList += `<li>${error}</li>`;
        });
        errorList += '</ul>';

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: errorList,
        });
        sessionStorage.removeItem('validationErrors');
    }
});
