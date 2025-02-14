<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeparturesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departures')->insert([
            ['id' => 1, 'country' => 'Nederland', 'airport' => 'Schiphol', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'country' => 'België', 'airport' => 'Brussels Airport', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
