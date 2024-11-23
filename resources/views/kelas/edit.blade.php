@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kelas</h2>
        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="name_kelas" name="name_kelas" value="{{ $kelas->name_kelas }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
