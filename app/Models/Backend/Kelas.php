<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name_kelas', 'wali_kelas', 'jumlah_siswa'];

    public function siswas(): HasMany
    {
        return $this->hasMany(siswa::class, 'class_id');
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(absensi::class, 'class_id');
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class, 'class_id');
    }
}
