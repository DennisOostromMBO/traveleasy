<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Booking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('booking.customer')->get();
        return view('invoices.overzicht', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('booking.customer')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    // genereer de factuur gebaseerd op booking
    public function generate($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $invoice = new Invoice();
        $invoice->booking_id = $booking->id;
        $invoice->amount = $booking->total_amount;
        $invoice->status = 'Pending';
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully.');
    }
}
