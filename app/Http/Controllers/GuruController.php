<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
        ]);

        Guru::create($request->all());
        return redirect()->route('guru.index');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
        ]);

        $guru->update($request->all());
        return redirect()->route('guru.index');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index');
    }
}
