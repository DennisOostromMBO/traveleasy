<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Travel;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $travels = Travel::all();

        foreach ($customers as $customer) {
            foreach ($travels as $travel) {
                Booking::create([
                    'customer_id' => $customer->id,
                    'travel_id' => $travel->id,
                    'seat_number' => 'A' . rand(1, 100),
                    'purchase_date' => now(),
                    'purchase_time' => now(),
                    'booking_status' => 'Bevestigd',
                    'price' => rand(100, 1000),
                    'quantity' => rand(1, 5),
                    'special_requests' => 'None',
                    'is_active' => true,
                    'note' => 'dummy booking :D.',
                ]);
            }
        }
    }
}
