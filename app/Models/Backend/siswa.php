<?php

namespace App\Models\Backend;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'class_id',
        'nisn',
        'name',
        'date_of_birth',
        'address',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
