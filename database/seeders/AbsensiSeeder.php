<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\Absensi;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Absensi::factory(500)->create();
    }
}
