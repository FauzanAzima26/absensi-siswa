<!-- Modal -->
<div class="modal fade" id="downloadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-file-excel"></i> Export
                    Laporan Absensi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('panel.absensi.download') }}" method="post"
                    id="downloadForm">
                    @csrf

                    <div class="mb-3">
                        <label for="class_id">Kelas</label>
                        <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name_kelas }}</option>
                            @endforeach
                        </select>

                        @error('class_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="month">Month</label>
                        <select name="month" id="month" class="form-control @error('month') is-invalid @enderror">
                            <option value="">Pilih Bulan</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ old('month') == $month ? 'selected' : '' }}>
                                    {{ \DateTime::createFromFormat('!m', $month)->format('F') }}
                                </option>
                            @endforeach
                        </select>

                        @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="year">Year</label>
                        <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                            <option value="">Pilih Tahun</option>
                            @foreach(range(date('Y') - 10, date('Y')) as $year)
                                <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>

                        @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i>
                    Cancel</button>
                <button type="submit" form="downloadForm" class="btn btn-secondary"><i class="fas fa-save"></i>
                    Submit</button>
            </div>
        </div>
    </div>
</div>
