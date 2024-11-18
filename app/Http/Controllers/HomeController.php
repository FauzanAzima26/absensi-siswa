<?php

namespace App\Http\Controllers;

use App\Models\Backend\guru;
use Illuminate\Http\Request;
use App\Models\Backend\Kelas;
use App\Models\Backend\siswa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $kelas = Kelas::all();
        // $guru = guru::all();
        // $siswa = siswa::all();
        // return view('backend.dashboard.index', compact('kelas', 'guru', 'siswa'));
        return view('backend.dashboard.index');
    }
}
