@extends('layouts.app')

@section('content')
    <h1>Daftar Guru</h1>
    <a href="{{ route('guru.create') }}">Tambah Guru</a>
    <table>
        <thead>
            <tr>
                <th>Nama Guru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guru as $g)
                <tr>
                    <td>{{ $g->nama_guru }}</td>
                    <td>
                        <a href="{{ route('guru.edit', $g->id) }}">Edit</a>
                        <form action="{{ route('guru.destroy', $g->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
