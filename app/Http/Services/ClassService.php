<?php

namespace App\Http\Services;

use App\Models\Backend\Kelas;

class ClassService
{
    public function select($column = null, $value = null)
    {
        if ($column) {
            return Kelas::where($column, $value)
                ->select('id', 'name_kelas')->firstOrFail();
        }

        return Kelas::latest()->get(['id', 'name_kelas']);
    }
}
