<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Backend\Kelas;
use App\Models\Backend\Absensi;
use App\Http\Controllers\Controller;
use App\Models\Backend\Siswa;
use Yajra\DataTables\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::with('siswa')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('absensi.show', $row->uuid) . '" class="btn btn-primary btn-sm" title="View">';
                    $btn .= '<i class="fa fa-eye"></i>';
                    $btn .= '</a>';
                    $btn .= '<a href="' . route('absensi.edit', $row->uuid) . '" class="btn btn-warning btn-sm" title="Edit">';
                    $btn .= '<i class="fa fa-edit"></i>';
                    $btn .= '</a>';
                    $btn .= '<button type="button" onclick="deleteAbsen(\'' . $row->uuid . '\')" class="btn btn-danger btn-sm" title="Delete">';
                    $btn .= '<i class="fa fa-trash"></i>';
                    $btn .= '</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.absensi siswa.absensi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
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
            Absensi::create([
                'uuid' => Str::uuid(),
                'student_id' => $studentId,
                'class_id' => $request->kelas_id,
                'date' => $request->tanggal,
                'status' => $data['status'],
                'keterangan' => $data['keterangan'] ?? '-',
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $absensi = Absensi::where('uuid', $uuid)->firstOrFail();
        return view('backend.absensi siswa.absensi.show', compact('absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $absensi = Absensi::where('uuid', $uuid)->firstOrFail();
        $kelas = Kelas::all();
        return view('backend.absensi siswa.absensi.edit', compact('absensi', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $absensi = Absensi::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'status' => 'required|string|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $absensi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $absensi = Absensi::where('uuid', $uuid)->firstOrFail();
            $absensi->delete();

            return response()->json(['message' => 'Absensi berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus absensi.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getSiswaByKelas($kelasId)
    {
        // Ambil siswa berdasarkan kelas
        $siswa = siswa::where('class_id', $kelasId)->get();

        if ($siswa->isEmpty()) {
            return response()->json(['message' => 'Tidak ada siswa ditemukan.'], 404);
        }

        return response()->json($siswa);
    }
}
