<?php

namespace Database\Factories\Backend;

use App\Models\Backend\Absensi;
use Illuminate\Database\Eloquent\Factories\Factory;


class AbsensiFactory extends Factory
{
    // Tentukan model yang diwakili oleh factory ini
    protected $model = Absensi::class;

    /**
     * Definisikan model default untuk factory ini.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 60),  
            'class_id' => $this->faker->numberBetween(1, 2), 
            'date' => $this->faker->dateTimeBetween('first day of January this year', 'last day of December this year')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['hadir', 'izin', 'sakit', 'alpha']),  
            'keterangan' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
