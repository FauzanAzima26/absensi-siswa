<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Backend\siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        siswa::factory(60)->create();
    }
}
