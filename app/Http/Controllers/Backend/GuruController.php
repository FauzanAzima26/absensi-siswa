<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Services\imageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\teacherRequest;
use App\Http\Services\teacherService;

class GuruController extends Controller
{
    public function __construct(
        private teacherService $teacherService,
        private imageService $imageService
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


    public function store(TeacherRequest $request)
{
    $data = $request->validated();

    try {
        // Simpan gambar dan dapatkan path
        $data['image'] = $this->imageService->storeImage($data);

        // Buat User dan ambil ID yang baru dibuat
        $user = $this->teacherService->createUser ($data);

        // Buat Teacher dengan user_id yang baru dibuat
        $this->teacherService->create(array_merge($data, ['user_id' => $user->id]));

        return response()->json(['message' => 'Data guru has been created successfully!']);
    } catch (\Exception $e) {
        // Hapus gambar jika terjadi kesalahan
        if (isset($data['image'])) {
            $this->imageService->deleteImage($data['image'], 'images');
        }
        return response()->json(['message' => $e->getMessage()], 500);
    }   
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
