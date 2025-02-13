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
            Invoice::create([
                'booking_id' => $booking->id,
                'invoice_number' => 'FACT-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT),
                'invoice_date' => now(),
                'amount_excl_vat' => $booking->total_amount * 0.79,
                'vat' => $booking->total_amount * 0.21,
                'amount_incl_vat' => $booking->total_amount,
                'invoice_status' => 'In afwachting',
                'is_active' => true,
                'note' => 'Dit is een voorbeeldfactuur.',
            ]);
        }
    }
}
