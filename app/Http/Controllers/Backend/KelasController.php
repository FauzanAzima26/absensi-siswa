<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Kelas;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $kelas = Kelas::all();

        return view('backend.data umum.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('backend.data umum.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
            'jumlah_siswa' => 'required|string|max:255',
        ]);

        Kelas::create([
            'name_kelas' => $request->name,
            'wali_kelas' => $request->wali_kelas,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }
    public function show(string $id)
    {
        return view('backend.data umum.kelas.show');
    }

    public function edit(string $id)
    {
        $kelas = Kelas::where('id', $id)->firstOrFail();
    
        return view('backend.data umum.kelas.edit', compact('kelas'));
    }
    

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_kelas' => 'required|string|max:255',
            'wali_kelas' => 'required|string|max:255',
            'jumlah_siswa' => 'required|string|max:255',
        ]);
    
        $kelas = Kelas::findOrFail($id);
    
        $kelas->update([
            'name_kelas' => $request->name_kelas,
            'wali_kelas' => $request->wali_kelas,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);
    
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui!');
    }
    

    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }

    
}
