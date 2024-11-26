<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\teacherService;

class GuruController extends Controller
{
    public function __construct(
        private teacherService $teacherService
    )
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('backend.data umum.guru.index');
    }

    public function create()
    {
        return view('backend.data umum.guru.create');
    }


    public function store(Request $request)
    {
        
    }


    public function show(string $uuid)
    {
        
    }

    public function edit(string $uuid)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }

    public function getData()
    {
        return $this->teacherService->serverSide();
    }
}
