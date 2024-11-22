<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use App\Http\Services\ClassService;
use App\Http\Services\SiswaService;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{

    public function __construct(
        private ClassService $classService,
        private SiswaService $siswaService
    ) {}
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request): View
     {
         $search = $request->input('search', ''); 
         $perPage = $request->input('perPage', 10);
     
         $data = $this->siswaService->getWithPaginate($perPage, $search);
    
         return view('backend.data umum.siswa.index', [
             'siswas' => $data
         ]);
     }
     


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.data umum.siswa.create', [
            'kelas' => $this->classService->select()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaRequest $request)
{
    $data = $request->validated();

    try {
        $this->siswaService->create($data);

          session()->flash('success', 'Siswa has been created successfully.');
        } catch (\Exception $e) {
            // Flash pesan error jika terjadi kesalahan
            session()->flash('error', 'Failed to create siswa: ' . $e->getMessage());
        }

        // Redirect ke halaman index
        return redirect()->route('siswa.index');

}


    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('backend.data umum.siswa.show', [
        'siswa' => $this->siswaService->selectFirstBy('uuid', $uuid)
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.data umum.siswa.edit', [
            'siswa' => $this->siswaService->selectFirstBy('uuid', $uuid),
            'kelas' => $this->classService->select()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, string $uuid)
    {
        $data = $request->validated();

        try {
            $getSiswa = $this->siswaService->selectFirstBy('uuid', $uuid);
            $this->siswaService->update($data, $uuid);

            return redirect()->route('siswa.index')->with('success', 'Siswa has been updated');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
{
    try {
        $getSiswa = $this->siswaService->selectFirstBy('uuid', $uuid);
        $getSiswa->delete();
        return response()->json([
            'message' => 'Siswa has been deleted successfully.'
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to delete siswa: ' . $e->getMessage()
        ], 500);
    }
}

}
