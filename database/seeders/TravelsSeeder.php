<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TravelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('travels')->insert([
            [
                'employee_id' => 1, // Zorg ervoor dat dit ID bestaat in de employees-tabel
                'departure_id' => 1, // Zorg ervoor dat dit ID bestaat in de departures-tabel
                'destination_id' => 1, // Zorg ervoor dat dit ID bestaat in de destinations-tabel
                'flight_number' => 'KL1234',
                'departure_date' => '2025-03-25',
                'departure_time' => '08:30:00',
                'arrival_date' => '2025-03-25',
                'arrival_time' => '12:45:00',
                'travel_status' => 'Gepland',
                'is_active' => true,
                'note' => 'Zakelijke vlucht',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'departure_id' => 2,
                'destination_id' => 2,
                'flight_number' => 'AF5678',
                'departure_date' => '2025-04-10',
                'departure_time' => '14:00:00',
                'arrival_date' => '2025-04-10',
                'arrival_time' => '18:30:00',
                'travel_status' => 'Gepland',
                'is_active' => true,
                'note' => 'Vakantiereis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
