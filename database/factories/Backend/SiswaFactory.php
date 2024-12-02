<?php

namespace Database\Factories\Backend;

use App\Models\Backend\siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    // Tentukan model yang diwakili oleh factory ini
    protected $model = siswa::class;

    /**
     * Definisikan model default untuk factory ini.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'class_id' => $this->faker->numberBetween(1, 2), 
            'nisn' => $this->faker->unique()->numerify('############'), 
            'name' => $this->faker->name(),  
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'address' => $this->faker->address(),  
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }

}
