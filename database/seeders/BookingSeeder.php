<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Travel;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $travels = Travel::all();
        $departures = DB::table('departures')->get()->keyBy('id'); // Fetch departures and key by id
        $destinations = DB::table('destinations')->get()->keyBy('id'); // Fetch destinations and key by id

        $totalBookings = $customers->count() * $travels->count();
        $saleBookingsCount = (int) ($totalBookings * 0.1); // 10% van alle boekingen

        $saleBookings = collect();

        foreach ($customers as $customer) {
            foreach ($travels as $travel) {
                $departure = $departures->get($travel->departure_id); // Get the departure details
                $destination = $destinations->get($travel->destination_id); // Get the destination details

                $booking = Booking::create([
                    'customer_id' => $customer->id,
                    'travel_id' => $travel->id,
                    'departure_country' => $departure->country, 
                    'destination_country' => $destination->country,
                    'departure_date' => $travel->departure_date,
                    'seat_number' => 'A' . rand(1, 100),
                    'purchase_date' => now(),
                    'purchase_time' => now(),
                    'booking_status' => 'Bevestigd',
                    'price' => rand(100, 1000),
                    'quantity' => rand(1, 5),
                    'special_requests' => 'None',
                    'is_active' => true,
                    'note' => 'dummy booking :D.',
                    'sale' => 0, // Default sale value
                ]);

                $saleBookings->push($booking);
            }
        }

        // Select random bookings for sale
        $saleBookings->random($saleBookingsCount)->each(function ($booking) {
            $booking->update(['sale' => rand(1, 50)]); // Assign a random sale percentage between 1 and 50
        });
    }
}
