@extends('backend.layouts.app')

@section('title', 'Add Absensi')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Absensi Siswa</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('absensi.index') }}">
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
                    <a href="#">Add Absensi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-primary rounded-top-3">
                        <div class="card-title text-white text-center font-weight-bold">Form Absensi Siswa</div>
                    </div>
                    <form action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas_id">Nama Kelas</label>
                                        <select class="form-control rounded" id="kelas_id" name="kelas_id" required>
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}">{{ $k->name_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Absensi</label>
                                        <input type="date" class="form-control rounded" id="tanggal" name="tanggal"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped rounded">
                                    <thead class="bg-light">
                                        <tr class="text-center">
                                            <th>Nama Siswa</th>
                                            <th>Status Absensi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="students-table-body" class="text-center">
                                        <!-- Data siswa akan dimasukkan di sini -->
                                    </tbody>
                                </table>
                                <div id="spinner" style="display: none;" class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action text-end">
                            <button class="btn btn-success rounded" type="submit">
                                <i class="fas fa-check"></i> Submit
                            </button>
                            <a href="{{ route('absensi.index') }}" class="btn btn-danger rounded">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script>
        document.getElementById('kelas_id').addEventListener('change', function() {
            const classId = this.value;
            const studentsTableBody = document.getElementById('students-table-body');
            const spinner = document.getElementById('spinner');
            studentsTableBody.innerHTML = '';
            spinner.style.display = 'block';

            if (classId) {
                fetch(`/kelas/${classId}/siswa`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        spinner.style.display = 'none';

                        if (data.length === 0) {
                            studentsTableBody.innerHTML =
                                '<tr><td colspan="3" class="text-center">Tidak ada siswa ditemukan.</td></tr>';
                        } else {
                            data.forEach(student => {
                                const row = `
                                    <tr>
                                        <td>${student.name}</td>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="students[${student.id}][status]" value="hadir" required checked> Hadir
                                                </label>
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="students[${student.id}][status]" value="sakit"> Sakit
                                                </label>
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="students[${student.id}][status]" value="izin"> Izin
                                                </label>
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="students[${student.id}][status]" value="alpha"> Alpha
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="students[${student.id}][keterangan]" placeholder="Keterangan (optional)" rows="2"></textarea>
                                        </td>
                                    </tr>
                                `;
                                studentsTableBody.insertAdjacentHTML('beforeend', row);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        spinner.style.display = 'none';
                    });
            } else {
                spinner.style.display = 'none';
            }
        });
    </script>
@endsection
