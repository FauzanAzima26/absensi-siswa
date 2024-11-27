@extends('backend.layouts.app')

@section('title', 'Edit Absensi Siswa')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Absensi Siswa</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('absensi.index') }}">Data Absensi</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Absensi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="p-4 border rounded bg-light">
                    <h5 class="mb-4">Edit Absensi: <strong>{{ $absensi->siswa->name }}</strong></h5>
                    <form action="{{ route('absensi.update', $absensi->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="hadir" {{ $absensi->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="alpha" {{ $absensi->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $absensi->keterangan }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end ms-2 me-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check" style="color: white;"></i> Update Absensi
                            </button>
                            <a href="{{ route('absensi.index') }}" class="btn btn-danger ms-2">
                                <i class="fas fa-times" style="color: white;"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
