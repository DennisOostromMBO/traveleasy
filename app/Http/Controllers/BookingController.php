<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = new Booking();
        $bookings = collect($booking->getAllBookings());
        $search = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $errors = new MessageBag();

        if ($search) {
            $bookings = $bookings->filter(function($booking) use ($search) {
                return stripos($booking->departure_country, $search) !== false || stripos($booking->destination_country, $search) !== false;
            });

            if ($bookings->isEmpty()) {
                $errors->add('search', 'Geen reizen gevonden.');
            }
        }

        if ($minPrice || $maxPrice) {
            $bookings = $bookings->filter(function($booking) use ($minPrice, $maxPrice) {
                if ($minPrice && $maxPrice) {
                    return $booking->price >= $minPrice && $booking->price <= $maxPrice;
                } elseif ($minPrice) {
                    return $booking->price >= $minPrice;
                } elseif ($maxPrice) {
                    return $booking->price <= $maxPrice;
                }
                return true;
            });

            if ($bookings->isEmpty()) {
                $errors->add('price', 'Geen reizen gevonden voor de opgegeven prijs.');
            }
        }

        if ($bookings->isEmpty() && !$search && !$minPrice && !$maxPrice) {
            $errors->add('search', 'Momenteel geen boekingen beschikbaar.');
        }

        // Convert collection to paginator
        $page = $request->input('page', 1);
        $perPage = 6;
        $items = $bookings->forPage($page, $perPage);
        
        $bookings = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $bookings->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

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

    public function sales(Request $request)
    {
        $bookings = Booking::where('sale', '>', 0)->paginate(6);

        return view('bookings.sales', compact('bookings'));
    }

    public function bookNow(Request $request, $id)
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login')->with('error', 'U moet ingelogd zijn om een boeking te maken.');
        }

        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Gebruiker niet gevonden. Probeer opnieuw in te loggen.');
        }

        // Check if the user has already purchased 4 or more bookings
        $existingBookingsCount = Booking::where('customer_id', $user->id)->count();
        if ($existingBookingsCount >= 4) {
            return redirect()->route('bookings.show', $id)->with('error', 'U kunt maximaal 4 boekingen per e-mailadres maken.');
        }

        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'travel_id' => 'required|exists:travels,id',
            'seat_number' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1|max:4',
            'special_requests' => 'nullable|string',
            'departure_country' => 'required|string|max:255',
            'destination_country' => 'required|string|max:255',
        ]);

        $booking = Booking::create([
            'customer_id' => $user->id,
            'travel_id' => $request->input('travel_id'),
            'seat_number' => $request->input('seat_number'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'special_requests' => $request->input('special_requests'),
            'departure_country' => $request->input('departure_country'),
            'destination_country' => $request->input('destination_country'),
            'purchase_date' => now()->toDateString(),
            'purchase_time' => now()->toTimeString(),
            'booking_status' => 'Confirmed',
            'is_active' => true,
        ]);

    }
}
