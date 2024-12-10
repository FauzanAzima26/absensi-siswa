<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Kelas;
use App\Http\Services\ClassService;
use App\Http\Services\imageService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\teacherRequest;
use App\Http\Services\teacherService;

class GuruController extends Controller
{
    public function __construct(
        private teacherService $teacherService,
        private imageService $imageService,
        private ClassService $classService
    ) {
        $this->middleware('admin');
    }

    public function index()
    {
        $kelas = $this->classService->select();
        return view('backend.data umum.guru.index', compact('kelas'));
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->validated();

        try {
            // Simpan gambar dan dapatkan path
            $data['image'] = $this->imageService->storeImage($data);

            // Buat User dan ambil ID yang baru dibuat
            $user = $this->teacherService->createUser($data);

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
    $teacher = $this->teacherService->getFirstBy('uuid', $uuid);

    $className = $teacher->class ? $teacher->class->name_kelas : null;

    return response()->json([
        'data' => array_merge(
            $teacher->only(['uuid', 'name', 'nip', 'address', 'phone', 'email', 'class_id', 'image']),
            ['class_name' => $className]
        ),
    ]);
}

    public function update(teacherRequest $request, string $id)
    {
        $data = $request->validated();

        // Ambil data guru berdasarkan UUID
        $getData = $this->teacherService->getFirstBy('uuid', $id);

        try {
            // Jika ada gambar baru yang di-upload
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($getData->image) {
                    $this->imageService->deleteImage($getData->image, 'images');
                }

                // Simpan gambar baru dan tambahkan ke data
                $data['image'] = $this->imageService->storeImage($data);
            }

            // Update user password if provided
            $user = User::find($getData->user_id);

            // Perbarui data pengguna lainnya jika ada
            if ($request->filled('name')) {
                $user->name = $request->name;
            }
            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            $user->save(); // Simpan perubahan pengguna

            // Hapus password dari data sebelum memperbarui guru
            unset($data['password']);

            // Perbarui data guru
            $this->teacherService->update(array_merge($data, ['user_id' => $getData->user_id]), $getData->uuid);

            return response()->json(['message' => 'Data guru telah diperbarui dengan sukses!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        $this->teacherService->getFirstBy('uuid', $id);

        $this->teacherService->delete($id);

        return response()->json(['message' => 'Data Guru Berhasil Dihapus...']);
    }

    public function getData()
    {
        return $this->teacherService->serverSide();
    }

    public function getClasses()
    {
        $kelas = Kelas::all(); // Ambil semua kelas dari database
        return response()->json($kelas); // Kembalikan sebagai JSON
    }
}
