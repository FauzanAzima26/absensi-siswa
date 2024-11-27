<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Kelas;
use App\Models\Backend\absensi;
use App\Http\Controllers\Controller;
use App\Models\Backend\siswa;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.absensi siswa.absensi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        // dd($kelas);
        return view('backend.absensi siswa.absensi.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'students' => 'required|array',
            'students.*.status' => 'required|string|in:hadir,sakit,izin,alpha',
            'students.*.keterangan' => 'nullable|string',
        ]);

        foreach ($request->students as $studentId => $data) {

            absensi::create([
                'uuid' => Str::uuid(),
                'student_id' => $studentId,
                'class_id' => $request->kelas_id,
                'status' => $data['status'],
                'keterangan' => $data['keterangan'] ?? null,
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('backend.absensi siswa.absensi.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.absensi siswa.absensi.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSiswaByKelas($kelasId)
    {
        // Ambil siswa berdasarkan kelas
        $siswa = siswa::where('class_id', $kelasId)->get(); // Pastikan 'class_id' adalah kolom yang sesuai

        if ($siswa->isEmpty()) {
            return response()->json(['message' => 'Tidak ada siswa ditemukan.'], 404);
        }

        return response()->json($siswa);
    }
}
