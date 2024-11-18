@extends('backend.layouts.app')

@section('title', 'Rekap Absensi')

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
                  <a href="#">Rekap Absensi</a>
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
                    <div class="card-title">Rekap Absensi</div>
                    <a href="{{ route ('rekap.create') }}" class="btn btn-success btn-sm ms-auto">
                        <i class="fa fa-plus"></i> Tambah Rekap
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alpha</th>
                            <th>Terlambat</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

