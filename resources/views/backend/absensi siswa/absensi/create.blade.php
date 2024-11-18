@extends('backend.layouts.app')

@section('title', 'Add Absensi')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Absensi Siswa</h3>
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
                <a href="#">Add Absensi</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Absensi</div>
                </div>
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Siswa</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           placeholder="Enter nama Siswa"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text"
                                           class="form-control @error('kelas') is-invalid @enderror"
                                           id="kelas"
                                           name="kelas"
                                           placeholder="Enter Kelas"
                                           value="{{ old('kelas') }}"
                                           required>
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date"
                                           class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal"
                                           name="tanggal"
                                           value="{{ old('tanggal') }}"
                                           required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <select class="form-control @error('keterangan') is-invalid @enderror"
                                            id="keterangan"
                                            name="keterangan"
                                            required>
                                        <option value="">Pilih Keterangan</option>
                                        <option value="Hadir" {{ old('keterangan') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Alpha" {{ old('keterangan') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                        <option value="Izin" {{ old('keterangan') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="Terlambat" {{ old('keterangan') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                    </select>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-check"></i> Submit
                        </button>
                        <a href="{{ route('absensi.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


