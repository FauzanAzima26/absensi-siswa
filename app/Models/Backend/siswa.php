<?php

namespace App\Models\Backend;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsTo(Kelas::class, 'class_id');
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'student_id');
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
