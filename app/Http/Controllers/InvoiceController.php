<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Booking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $invoices = Invoice::with('booking.customer.person')
            ->when($search, function ($query, $search) {
                return $query->whereHas('booking.customer.person', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('invoices.overzicht', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('booking.customer.person')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function create()
    {
        $bookings = Booking::with('customer.person')->get();
        return view('invoices.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'invoice_date' => 'required|date',
            'invoice_status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $amount_incl_vat = $booking->price;
        $vat = $amount_incl_vat * 0.21;
        $amount_excl_vat = $amount_incl_vat - $vat;

        Invoice::create([
            'booking_id' => $request->booking_id,
            'invoice_number' => 'FACT-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT),
            'invoice_date' => $request->invoice_date,
            'amount_excl_vat' => $amount_excl_vat,
            'vat' => $vat,
            'amount_incl_vat' => $amount_incl_vat,
            'invoice_status' => $request->invoice_status,
            'is_active' => $request->is_active,
            'note' => $request->note,
        ]);

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
            'invoice_date' => 'required|date',
            'invoice_status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        $booking = Booking::findOrFail($request->booking_id);
        $amount_incl_vat = $booking->price;
        $vat = $amount_incl_vat * 0.21;
        $amount_excl_vat = $amount_incl_vat - $vat;

        $invoice->update([
            'booking_id' => $request->booking_id,
            'invoice_date' => $request->invoice_date,
            'amount_excl_vat' => $amount_excl_vat,
            'vat' => $vat,
            'amount_incl_vat' => $amount_incl_vat,
            'invoice_status' => $request->invoice_status,
            'is_active' => $request->is_active,
            'note' => $request->note,
        ]);

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
        $amount_incl_vat = $booking->price;
        $vat = $amount_incl_vat * 0.21;
        $amount_excl_vat = $amount_incl_vat - $vat;

        $invoice = new Invoice();
        $invoice->booking_id = $booking->id;
        $invoice->invoice_number = 'FACT-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
        $invoice->invoice_date = now();
        $invoice->amount_excl_vat = $amount_excl_vat;
        $invoice->vat = $vat;
        $invoice->amount_incl_vat = $amount_incl_vat;
        $invoice->invoice_status = 'In afwachting';
        $invoice->is_active = true;
        $invoice->note = 'Dit is een voorbeeldfactuur.';
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully.');
    }
}
