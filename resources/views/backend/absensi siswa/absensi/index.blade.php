@extends('backend.layouts.app')

@section('title', 'Absensi Siswa')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" />
@endpush

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
                    <a href="#">Data Absensi</a>
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
                        <div class="card-title">Data Absensi</div>
                        @if (Auth::user()->role !== 'admin')
                            <a href="{{ route('absensi.create') }}" class="btn btn-success btn-sm ms-auto">
                                <i class="fa fa-plus"></i> Add Absen
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="absensi-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Ket</th>
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

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#absensi-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('absensi.index') }}',
                    responsive: true,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'siswa.name',
                            name: 'siswa.name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan',
                            render: function(data, type, row) {
                                if (data) {
                                    return data.length > 50 ? data.substring(0, 50) + '...' : data;
                                }
                                return 'Tidak ada keterangan';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush

@endsection
