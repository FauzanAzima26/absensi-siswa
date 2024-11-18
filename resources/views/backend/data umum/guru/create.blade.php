@extends('backend.layouts.app')

@section('title', 'Add Guru')

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
                <a href="#">Add Guru</a>
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
                    <div class="card-title">Add Guru</div>
                </div>
                <form action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Input Nama Guru -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Nama Guru</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           placeholder="Enter nama guru" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input NIP Guru -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" 
                                           class="form-control @error('nip') is-invalid @enderror" 
                                           id="nip" 
                                           name="nip" 
                                           placeholder="Enter nip" 
                                           value="{{ old('nip') }}" 
                                           required>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Input Mata Pelajaran -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="matpel">Guru Pengampu</label>
                                    <input type="text" 
                                           class="form-control @error('guru pengampu') is-invalid @enderror" 
                                           id="matpel" 
                                           name="matpel" 
                                           placeholder="Enter guru pengampu" 
                                           value="{{ old('guru pengampu') }}" 
                                           required>
                                    @error('guru pengampu')
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
                        <a href="{{ route('guru.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

