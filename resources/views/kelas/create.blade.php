@extends('layouts.app')

@section('content')
    <h1>Tambah Kelas</h1>
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" name="nama_kelas" id="nama_kelas" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
