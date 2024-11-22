@extends('backend.layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Umum</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('siswa.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Siswa: {{ $siswa->name }}</a>
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
                    <div class="card-title">Edit Siswa</div>
                </div>

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('siswa.update', ['siswa' => $siswa->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Input Kelas -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="class_id">Kelas</label>
                                    <select name="class_id" id="class_id" class="form-select @error('class_id') is-invalid @enderror">
                                        <option value="">-- select class --</option>
                                        @foreach ($kelas as $class)
                                            <option value="{{ $class->id }}" {{ $class->id == $siswa->class_id ? 'selected' : '' }}>
                                                {{ $class->name_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input NISN -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="number"
                                           class="form-control @error('nisn') is-invalid @enderror"
                                           id="nisn"
                                           name="nisn"
                                           placeholder="Enter nisn"
                                           value="{{ old('nisn', $siswa->nisn) }}"
                                           required>
                                    @error('nisn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Nama -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           placeholder="Enter nama"
                                           value="{{ old('name', $siswa->name) }}"
                                           required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Tanggal Lahir -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input type="date"
                                           class="form-control @error('date_of_birth') is-invalid @enderror"
                                           id="date_of_birth"
                                           name="date_of_birth"
                                           value="{{ old('date_of_birth', $siswa->date_of_birth) }}"
                                           required>
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Alamat -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text"
                                           class="form-control @error('address') is-invalid @enderror"
                                           id="address"
                                           name="address"
                                           placeholder="Enter alamat"
                                           value="{{ old('address', $siswa->address) }}"
                                           required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                            <i class="fas fa-times"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

