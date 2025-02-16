<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'customer_id' => 1,
                'travel_id' => 1,
                'seat_number' => 'A1',
                'purchase_date' => Carbon::now()->format('Y-m-d'),
                'purchase_time' => Carbon::now()->format('H:i:s'),
                'booking_status' => 'confirmed',
                'price' => 100.00,
                'quantity' => 1,
                'special_requests' => 'None',
                'is_active' => 1,
                'note' => 'First booking',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 2,
                'travel_id' => 2,
                'seat_number' => 'B2',
                'purchase_date' => Carbon::now()->format('Y-m-d'),
                'purchase_time' => Carbon::now()->format('H:i:s'),
                'booking_status' => 'pending',
                'price' => 150.00,
                'quantity' => 2,
                'special_requests' => 'Vegetarian meal',
                'is_active' => 1,
                'note' => 'Second booking',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // voeg meer toe als het nodig is
        ]);
    }
}
