<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommunicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('communications')->insert([
            [
                'customer_id' => 1, // Zorg ervoor dat er een klant met dit ID bestaat
                'employee_id' => 2, // Zorg ervoor dat er een werknemer met dit ID bestaat
                'message' => 'Welkom bij ons bedrijf!',
                'sent_date' => Carbon::now(),
                'is_active' => true,
                'note' => 'Initial welcome message',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Voeg hier meer records toe als dat nodig is
        ]);
    }
}