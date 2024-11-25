<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct()
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
        return view('backend.data umum.guru.store');
    }


    public function show(string $uuid)
    {
        return view('backend.data umum.guru.show');
    }

    public function edit(string $uuid)
    {
        return view('backend.data umum.guru.edit');
    }

    public function update(Request $request, string $id)
    {
        return view('backend.data umum.guru.update');
    }

    public function destroy(string $id)
    {
        return view('backend.data umum.guru.destroy');
    }
}
