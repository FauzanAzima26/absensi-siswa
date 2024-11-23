@extends('backend.layouts.app')

@section('title', 'Add Kelas')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Umum</h3>
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
                <a href="#">Add Kelas</a>
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
                    <div class="card-title">Add Kelas</div>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Input Nama Kelas -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Kelas</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           placeholder="Enter nama kelas" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Wali Kelas -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="wali_kelas">Wali Kelas</label>
                                    <input type="text" 
                                           class="form-control @error('wali_kelas') is-invalid @enderror" 
                                           id="wali_kelas" 
                                           name="wali_kelas" 
                                           placeholder="Enter wali kelas" 
                                           value="{{ old('wali_kelas') }}" 
                                           required>
                                    @error('wali_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Jumlah Siswa -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="jumlah_siswa">Jumlah Siswa</label>
                                    <input type="number" 
                                           class="form-control @error('jumlah_siswa') is-invalid @enderror" 
                                           id="jumlah_siswa" 
                                           name="jumlah_siswa" 
                                           placeholder="Enter jumlah siswa" 
                                           value="{{ old('jumlah_siswa') }}" 
                                           required>
                                    @error('jumlah_siswa')
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
                        <a href="{{ route('kelas.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
