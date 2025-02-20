<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = new Booking();
        $bookings = collect($booking->getAllBookings());
        $search = $request->input('search');
        $errors = new MessageBag();

        if ($search) {
            $bookings = $bookings->filter(function($booking) use ($search) {
                return stripos($booking->departure_country, $search) !== false || stripos($booking->destination_country, $search) !== false;
            });

            if ($bookings->isEmpty()) {
                $errors->add('search', 'Geen reizen gevonden.');
            }
        }

        if ($bookings->isEmpty() && !$search) {
            $errors->add('search', 'Momenteel geen boekingen beschikbaar.');
        }

        return view('bookings.index', compact('bookings', 'errors'));
    }

    public function show($id)
    {
        $booking = Booking::with('customer.person')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'travel_id' => 'required|exists:travels,id',
            'seat_number' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'purchase_time' => 'required|date_format:H:i',
            'booking_status' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'special_requests' => 'nullable|string',
            'is_active' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'seat_number' => 'required|string|max:255',
            'price' => 'required|numeric',
            'booking_status' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->only(['seat_number', 'price', 'booking_status', 'special_requests', 'note']));

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
