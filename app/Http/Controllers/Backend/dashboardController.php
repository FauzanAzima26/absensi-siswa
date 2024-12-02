<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Kelas;
use App\Models\Backend\siswa;
use App\Models\Backend\absensi;
use App\Models\Backend\Teacher;
use Illuminate\Support\Facades\DB;
use App\Http\Services\ClassService;
use App\Http\Services\SiswaService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(
        private ClassService $classService,
        private SiswaService $siswaService
    ) {}

    public function index()
    {
        $totalAbsensi = absensi::count();
        $totalGuru = Teacher::count();
        $totalKelas = Kelas::count();
        $totalSiswa = siswa::count();
        $data = DB::table('absensis')
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'status')
            ->get();


        $months = [];
        $hadir = [];
        $sakit = [];
        $izin = [];
        $alpha = [];

        foreach ($data as $row) {
            $month = date('M', mktime(0, 0, 0, $row->month, 10)) . '-' . substr($row->year, 2);
            if (!in_array($month, $months)) {
                $months[] = $month;
            }

            $hadir[$month] = ($row->status == 'hadir') ? ($hadir[$month] ?? 0) + $row->count : ($hadir[$month] ?? 0);
            $sakit[$month] = ($row->status == 'sakit') ? ($sakit[$month] ?? 0) + $row->count : ($sakit[$month] ?? 0);
            $izin[$month] = ($row->status == 'izin') ? ($izin[$month] ?? 0) + $row->count : ($izin[$month] ?? 0);
            $alpha[$month] = ($row->status == 'alpha') ? ($alpha[$month] ?? 0) + $row->count : ($alpha[$month] ?? 0);
        }

        $kelas = $this->classService->select();


        return view('backend.dashboard.index', compact(
            'totalAbsensi',
            'totalGuru',
            'totalKelas',
            'totalSiswa',
            'months',
            'hadir',
            'sakit',
            'izin',
            'alpha',
            'kelas'

        ));
    }
}
