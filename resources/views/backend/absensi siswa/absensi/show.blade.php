@extends('backend.layouts.app')

@section('title', 'Detail Absensi Siswa')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Data Absensi Siswa</h3>
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
                    <a href="#">Detail Absensi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detail Absensi : <strong>{{ $absensi->siswa->name }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #4e73df; color: white;">
                                <tr>
                                    <th>Informasi</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>{{ $absensi->siswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ ucfirst($absensi->status) }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>
                                        <textarea class="form-control" rows="3" style="resize: none;" readonly>{{ $absensi->keterangan ?? 'Tidak ada keterangan' }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('absensi.index') }}" class="btn btn-warning">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
