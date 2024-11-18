@extends('backend.layouts.app')

@section('title', 'Add Rekap Absensi')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Rekap Absensi</h3>
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
                <a href="#">Add Rekap Absensi</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="card-title">Add Rekap Absensi</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('rekap.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <!-- Input Nama Siswa -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" 
                                           class="form-control @error('nama_siswa') is-invalid @enderror" 
                                           id="nama_siswa" 
                                           name="nama_siswa" 
                                           placeholder="Enter nama Siswa" 
                                           value="{{ old('nama_siswa') }}" 
                                           required>
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Kelas -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" 
                                           class="form-control @error('kelas') is-invalid @enderror" 
                                           id="kelas" 
                                           name="kelas" 
                                           placeholder="Enter kelas" 
                                           value="{{ old('kelas') }}" 
                                           required>
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Tanggal -->
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

                            <!-- Input Total Kehadiran, Alpha, Izin, Terlambat, Sakit -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_hadir">Total Hadir</label>
                                    <input type="number" 
                                           class="form-control @error('total_hadir') is-invalid @enderror" 
                                           id="total_hadir" 
                                           name="total_hadir" 
                                           placeholder="Total Kehadiran"
                                           value="{{ old('total_hadir') }}" 
                                           required>
                                    @error('total_hadir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_alpha">Total Alpha</label>
                                    <input type="number" 
                                           class="form-control @error('total_alpha') is-invalid @enderror" 
                                           id="total_alpha" 
                                           name="total_alpha" 
                                           placeholder="Total Alpha"
                                           value="{{ old('total_alpha') }}" 
                                           required>
                                    @error('total_alpha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_izin">Total Izin</label>
                                    <input type="number" 
                                           class="form-control @error('total_izin') is-invalid @enderror" 
                                           id="total_izin" 
                                           name="total_izin" 
                                           placeholder="Total Izin"
                                           value="{{ old('total_izin') }}" 
                                           required>
                                    @error('total_izin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_terlambat">Total Terlambat</label>
                                    <input type="number" 
                                           class="form-control @error('total_terlambat') is-invalid @enderror" 
                                           id="total_terlambat" 
                                           name="total_terlambat" 
                                           placeholder="Total Terlambat"
                                           value="{{ old('total_terlambat') }}" 
                                           required>
                                    @error('total_terlambat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_sakit">Total Sakit</label>
                                    <input type="number" 
                                           class="form-control @error('total_sakit') is-invalid @enderror" 
                                           id="total_sakit" 
                                           name="total_sakit" 
                                           placeholder="Total Sakit"
                                           value="{{ old('total_sakit') }}" 
                                           required>
                                    @error('total_sakit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tombol Submit dan Cancel -->
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                                <a href="{{ route('rekap.index') }}" class="btn btn-danger">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

