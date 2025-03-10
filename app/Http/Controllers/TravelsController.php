<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use Carbon\Carbon;

class TravelsController extends Controller
{
    public function index()
    {
        $travels = DB::select('CALL spGetAllTravels()');
        return view('travels.index', ['travels' => $travels]);
    }

    public function create()
    {
        $employees = DB::table('employees')
            ->join('persons', 'employees.person_id', '=', 'persons.id')
            ->select('employees.id', DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS full_name"))
            ->get();

        $departures = DB::table('departures')->select('id', 'country', 'airport')->get();
        $destinations = DB::table('destinations')->select('id', 'country', 'airport')->get();

        return view('travels.create', compact('employees', 'departures', 'destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'departure_id' => 'required|exists:departures,id',
            'destination_id' => 'required|exists:destinations,id',
            'flight_number' => 'required|string|max:255',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => 'required|date_format:H:i',
            'travel_status' => 'required|string|max:255',
        ]);

        // Check for duplicate travel entries based on departure, destination, date, and time
        $existingTravel = Travel::where('departure_id', $request->departure_id)
            ->where('destination_id', $request->destination_id)
            ->where('departure_date', $request->departure_date)
            ->where('departure_time', $request->departure_time)
            ->first();

        if ($existingTravel) {
            return redirect()->back()->withErrors(['Deze reis bestaat al op hetzelfde tijdstip met dezelfde vertrek- en bestemmingslocatie.']);
        }

        // Check for duplicate flight numbers on the same day
        $existingFlightNumber = Travel::where('flight_number', $request->flight_number)
            ->where('departure_date', $request->departure_date)
            ->first();

        if ($existingFlightNumber) {
            return redirect()->back()->withErrors(['Deze vluchtnummer bestaat al op dezelfde dag.']);
        }

        try {
            DB::statement('CALL spCreateTravel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->employee_id,
                $request->departure_id,
                $request->destination_id,
                $request->flight_number,
                $request->departure_date,
                $request->departure_time,
                $request->arrival_date,
                $request->arrival_time,
                $request->travel_status,
                1 // is_active standaard op 1 zetten
            ]);

            return redirect()->route('travels.index')->with('success', 'Reis succesvol toegevoegd!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Fout bij opslaan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $travel = Travel::findOrFail($id);
        $employees = DB::table('employees')
            ->join('persons', 'employees.person_id', '=', 'persons.id')
            ->select('employees.id', DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS full_name"))
            ->get();

        $departures = DB::table('departures')->select('id', 'country', 'airport')->get();
        $destinations = DB::table('destinations')->select('id', 'country', 'airport')->get();

        return view('travels.edit', compact('travel', 'employees', 'departures', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'departure_id' => 'required|exists:departures,id',
            'destination_id' => 'required|exists:destinations,id',
            'flight_number' => 'required|string|max:255',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => 'required|date_format:H:i',
            'travel_status' => 'required|string|max:255',
        ]);

        // Check for duplicate travel entries based on departure, destination, date, and time
        $existingTravel = Travel::where('departure_id', $request->departure_id)
            ->where('destination_id', $request->destination_id)
            ->where('departure_date', $request->departure_date)
            ->where('departure_time', $request->departure_time)
            ->where('id', '!=', $id)
            ->first();

        if ($existingTravel) {
            return redirect()->back()->withErrors(['Er bestaat al een reis op dit tijdstip voor deze route.']);
        }

        // Check for duplicate flight numbers on the same day
        $existingFlightNumber = Travel::where('flight_number', $request->flight_number)
            ->where('departure_date', $request->departure_date)
            ->where('id', '!=', $id)
            ->first();

        if ($existingFlightNumber) {
            return redirect()->back()->withErrors(['Deze vluchtnummer bestaat al op dezelfde dag.']);
        }

        try {
            DB::statement('CALL spUpdateTravel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $request->employee_id,
                $request->departure_id,
                $request->destination_id,
                $request->flight_number,
                $request->departure_date,
                $request->departure_time,
                $request->arrival_date,
                $request->arrival_time,
                $request->travel_status,
                1 // is_active standaard op 1 zetten
            ]);

            return redirect()->route('travels.index')->with('success', 'Reis succesvol bijgewerkt!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Fout bij opslaan: ' . $e->getMessage());
        }
    }
}