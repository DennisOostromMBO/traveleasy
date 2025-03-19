<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function bookings(Request $request)
    {
        $bookings = collect();

        if ($request->has(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            $bookings = Booking::with('customer.person')
                ->whereBetween('purchase_date', [$start_date, $end_date])
                ->get();
        } else {
            // Fetch all bookings if no date range is provided
            $bookings = Booking::with('customer.person')->get();
        }

        // Calculate the most popular destinations and starting points
        $popularDestinations = $bookings->groupBy('destination_country')->map->count()->sortDesc();
        $popularStartingPoints = $bookings->groupBy('departure_country')->map->count()->sortDesc();

        return view('manager.dashboard', compact('bookings', 'popularDestinations', 'popularStartingPoints'));
    }
}
