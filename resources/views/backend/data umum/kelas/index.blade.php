@extends('backend.layouts.app')

@section('title', 'Daftar Kelas')

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
                  <a href="#">Daftar Kelas</a>
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
                    <div class="card-title">Daftar Kelas</div>
                    <a href="{{ route('kelas.create') }}" class="btn btn-success btn-sm ms-auto">
                        <i class="fa fa-plus"></i> Add Kelas
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Siswa</th>
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






