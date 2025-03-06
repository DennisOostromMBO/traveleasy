<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;

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
}