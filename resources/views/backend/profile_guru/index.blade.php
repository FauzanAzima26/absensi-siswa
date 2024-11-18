@extends('backend.layouts.app') {{-- Extend layout utama --}}

@section('content')
<div class="container">
    <div class="card shadow-sm mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Profile Guru › </h2>
        </div>
        <div class="card-body">

            {{-- Bagian Gambar di Tengah --}}
            <div class="text-center mb-5">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                <button class="btn btn-link text-primary d-block mt-2">Change Picture</button>
            </div>

            <form method="POST" action="{{ route('profile_guru.index') }}"> 
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Bagian Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Nama Depan</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nama Belakang</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                            <a href="#" class="text-primary d-block mt-2">Change Password</a>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" name="address" id="address" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="nation" class="form-label">Kewarganegaraan</label>
                            <input type="text" name="nation" id="nation" class="form-control" value="">
                        </div>
                    </div>

                    {{-- Bagian Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value=""selected></option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label">Bahasa</label>
                            <select name="language" id="language" class="form-select">
                                <option value=""selected></option>
                                <option value="indonesia">Indonesia</option>
                                <option value="english">English</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="Tanggal_Lahir" id="tanggal_lahir" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="card-action">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-check"></i> Submit
                        </button>
                        <a href="{{ route('profile_guru.index') }}" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
