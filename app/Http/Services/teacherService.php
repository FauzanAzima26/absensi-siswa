<?php

namespace App\Http\Services;

use App\Models\Backend\Teacher;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class teacherService
{
    public function serverSide()
    {
        $totalData = Teacher::count();
        $totalFiltered = $totalData;
        $limit = request()->length;
        $start = request()->start;

        if (empty(request()->search['value'])) {
            $data = Teacher::latest()
                ->with('user:id,name')
                ->offset($start)
                ->limit($limit)
                ->get(['id', 'uuid', 'user_id', 'nip', 'name', 'email', 'phone', 'address', 'image']);
        } else {
            $data = Teacher::filter(request()->search['value'])
                ->latest()
                ->with('user:id,name')
                ->offset($start)
                ->limit($limit)
                ->get(['id', 'uuid', 'user_id', 'nip', 'name', 'email', 'phone', 'address', 'image']);

            $totalFiltered = $data->count();
        }

        // Menambahkan URL gambar
        foreach ($data as $teacher) {
            $teacher->image = url('storage/images/' . $teacher->image); // Menghasilkan URL gambar
        }

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn =
                    '<div class="text-center" width="10%">
                    <div class="btn-group">
                        <a href="#"  class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        <a href="#"  class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="destroyTeacher(this)" data-id="' . $row->uuid . '"><i class="fas fa-trash"></i></button>
                    </div>
                </div>';
                return $btn;
            })
            ->with([
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'start' => $start,
            ])
            ->setOffset($start)
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }


    public function createUser($data)
    {
        // Hanya ambil data yang diperlukan untuk User
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        return User::create($userData);
    }

    public function create($data)
    {
        // Hanya ambil data yang diperlukan untuk Teacher
        $teacherData = [
            'user_id' => $data['user_id'], // ID User yang baru dibuat
            'image' => $data['image'],
            'nip' => $data['nip'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];

        return Teacher::create($teacherData);
    }

    public function getUser()
    {
        return User::latest()->get(['id', 'name']);
    }

}