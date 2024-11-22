<?php


namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index');
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index');
    }
}
