<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Booking;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            $amount_excl_vat = $booking->price * 0.79;
            $vat = $booking->price * 0.21;
            $amount_incl_vat = $booking->price;

            Invoice::create([
                'booking_id' => $booking->id,
                'invoice_number' => 'FACT-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT),
                'invoice_date' => now(),
                'amount_excl_vat' => $amount_excl_vat,
                'vat' => $vat,
                'amount_incl_vat' => $amount_incl_vat,
                'invoice_status' => 'In afwachting',
                'is_active' => true,
                'note' => 'Dit is een voorbeeldfactuur.',
            ]);
        }
    }
}
