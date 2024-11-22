@extends('layouts.app')

@section('content')
    <h1>Tambah Guru</h1>
    <form action="{{ route('guru.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_guru">Nama Guru:</label>
            <input type="text" name="nama_guru" id="nama_guru" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
