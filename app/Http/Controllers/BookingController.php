<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bookings = Booking::with('customer.person')
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer.person', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
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
