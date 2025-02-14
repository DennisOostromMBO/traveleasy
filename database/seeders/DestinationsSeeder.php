<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DestinationsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('destinations')->insert([
            ['id' => 1, 'country' => 'Spanje', 'airport' => 'Madrid Barajas', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'country' => 'Frankrijk', 'airport' => 'Charles de Gaulle', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
