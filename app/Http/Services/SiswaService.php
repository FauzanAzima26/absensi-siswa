<?php

namespace App\Http\Services;

use App\Models\Backend\Siswa;

class SiswaService
{
    public function select($paginate = null)
{
    $query = Siswa::orderBy('class_id') 
                  ->orderBy('name');     

    if ($paginate) {
        return $query->paginate($paginate);
    }

    return $query->get();
}


    public function selectFirstBy($column, $value)
    {
        return Siswa::where($column, $value)->firstOrFail();
    }
    public function create($data)
    {

        return Siswa::create($data);
    }

    public function update($data, $uuid)
    {

        return Siswa::where('uuid', $uuid)->update($data);
    }

    public function getWithPaginate(int $paginate = 10, ?string $search = null)
    {
        $query = Siswa::orderBy('class_id')
        ->orderBy('name')
        ->select(['uuid', 'name', 'class_id', 'date_of_birth', 'address', 'nisn']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('class', function ($q) use ($search) {
                      $q->where('name_kelas', 'like', "%{$search}%");
                  })->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('date_of_birth', 'like', "%{$search}%");
        }

        return $query->paginate($paginate);
    }

}
