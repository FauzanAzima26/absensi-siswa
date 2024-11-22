@extends('backend.layouts.app')

@section('title', 'Detail Siswa: ' . $siswa->name)

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
                <a href="#">Detail Siswa: {{ $siswa->name }}</a>
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
                    <div class="card-title">Detail Siswa</div>
                </div>

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        {{-- Table --}}
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>NISN</th>
                                        <td>: {{ $siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ $siswa->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>: {{ $siswa->class->name_kelas ?? 'Tidak ada kelas' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>: {{ $siswa->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $siswa->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>: {{ date('Y-m-d H:i:s', strtotime($siswa->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>: {{ date('Y-m-d H:i:s', strtotime($siswa->updated_at)) }}</td>
                                    </tr>
                                </table>

                                <div class="float-end mt-2">
                                    <a href="{{ route('siswa.index') }}" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                    <a href="{{ route('siswa.edit', ['siswa' => $siswa->uuid]) }}" class="btn btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
