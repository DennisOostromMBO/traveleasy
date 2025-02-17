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

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'invoice_number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'amount_excl_vat' => 'required|numeric',
            'vat' => 'required|numeric',
            'amount_incl_vat' => 'required|numeric',
            'invoice_status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        Invoice::create($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'invoice_number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'amount_excl_vat' => 'required|numeric',
            'vat' => 'required|numeric',
            'amount_incl_vat' => 'required|numeric',
            'invoice_status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function generate($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $invoice = new Invoice();
        $invoice->booking_id = $booking->id;
        $invoice->invoice_number = 'FACT-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
        $invoice->invoice_date = now();
        $invoice->amount_excl_vat = $booking->price * 0.79;
        $invoice->vat = $booking->price * 0.21;
        $invoice->amount_incl_vat = $booking->price;
        $invoice->invoice_status = 'In afwachting';
        $invoice->is_active = true;
        $invoice->note = 'Dit is een voorbeeldfactuur.';
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully.');
    }
}
