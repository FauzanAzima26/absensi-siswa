<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use App\Http\Services\ClassService;
use App\Http\Services\SiswaService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Backend\Kelas;  

class ExportController extends Controller
{
    public function __construct(
        private ClassService $classService,
        private SiswaService $siswaService
    ) {
        
    }

    /**
     * Menangani ekspor absensi per kelas.
     */
    public function download(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:kelas,id', 
            'month' => 'required|integer|between:1,12', 
            'year' => 'required|integer|between:2000,2100', 
        ]);

        $class_id = $validated['class_id'];
        $month = $validated['month'];
        $year = $validated['year'];

        $kelas = Kelas::find($class_id);
        if (!$kelas) {
           
            return response()->json(['error' => 'Kelas tidak ditemukan'], 404);
        }

        $bulan = date('F', mktime(0, 0, 0, $month, 10)); 

        $namaFile = "Laporan Absensi_{$kelas->name_kelas}_{$bulan}_{$year}.xlsx";

        return Excel::download(new AbsensiExport($class_id, $month, $year), $namaFile);
    }
}
