@extends('backend.layouts.app')

@section('title', 'Add Siswa')

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
                <a href="#">Add Siswa</a>
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
                    <div class="card-title">Add Siswa</div>
                </div>
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Input Nama -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" 
                                           name="nama" 
                                           placeholder="Enter nama" 
                                           value="{{ old('nama') }}" 
                                           required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input NISN -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="text" 
                                           class="form-control @error('nisn') is-invalid @enderror" 
                                           id="nisn" 
                                           name="nisn" 
                                           placeholder="Enter nisn" 
                                           value="{{ old('nisn') }}" 
                                           required>
                                    @error('nisn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Kelas -->
                            <div class="col-md-6 mb-3">
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
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-check"></i> Submit
                        </button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

