<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'nip',
        'name',
        'email',
        'phone',
        'address',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public static function filter($search){
        return Teacher::where('name', 'like', "%{$search}%")
        ->orWhere('nip', 'like', "%{$search}%");
    }
}
