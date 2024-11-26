<?php

namespace App\Http\Services;

use App\Models\Backend\Teacher;
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
}