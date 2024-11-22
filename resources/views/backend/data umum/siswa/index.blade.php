@extends('backend.layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div class="page-inner">
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-3">Data Umum</h3>
            <ul class="breadcrumbs mb-3 d-flex align-items-center">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('siswa.index') }}">Daftar Siswa</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
            </ul>
        </div>

        <div class="d-flex justify-content-end">
            <form method="GET" action="{{ route('siswa.index') }}" class="d-flex align-items-center">
                <label for="perPage" class="me-2">Tampilkan:</label>
                <select name="perPage" id="perPage" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
        </div>
        

        <div class="d-flex">
            <form action="{{ url('siswa') }}" method="get" class="input-group w-auto" style="max-width: 400px;">
                <input type="search" name="search" class="form-control rounded-start border-primary shadow-sm"
                    placeholder="Cari siswa..." value="{{ request('search') }}" aria-label="Search">
                <button type="submit" class="btn btn-primary shadow-sm">Cari</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="card-title">Daftar Siswa</div>
                    <a href="{{ route('siswa.create') }}" class="btn btn-success btn-sm ms-auto">
                        <i class="fa fa-plus"></i> Add Siswa
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $item)
                                <tr>
                                    <td>{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->class->name_kelas ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('siswa.show', $item->uuid) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('siswa.edit', $item->uuid) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="deleteSiswa(this)"
                                                data-uuid="{{ $item->uuid }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Data Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($siswas->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                        {!! $siswas->appends([
                            'perPage' => request('perPage'),
                            'search' => request('search')
                            ])->links('pagination::bootstrap-5') !!}
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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

</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        window.location.reload();
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
    });
</script>
@endif

@endpush
