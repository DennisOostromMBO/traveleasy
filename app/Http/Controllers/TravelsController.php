<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Travel;
use Carbon\Carbon;

class TravelsController extends Controller
{
    public function index(Request $request)
    {
        $employeeId = $request->query('employee_id');

        $employees = DB::table('employees')
            ->join('persons', 'employees.person_id', '=', 'persons.id')
            ->select('employees.id', DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS full_name"))
            ->get();

        $travelsQuery = DB::table('travels')
            ->join('employees', 'travels.employee_id', '=', 'employees.id')
            ->join('persons', 'employees.person_id', '=', 'persons.id')
            ->join('departures', 'travels.departure_id', '=', 'departures.id')
            ->join('destinations', 'travels.destination_id', '=', 'destinations.id')
            ->select(
                'travels.id AS travel_id',
                DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS employee_name"),
                'departures.country AS departure_country',
                'departures.airport AS departure_airport',
                'destinations.country AS destination_country',
                'destinations.airport AS destination_airport',
                'travels.flight_number',
                'travels.departure_date',
                'travels.departure_time',
                'travels.arrival_date',
                'travels.arrival_time',
                'travels.travel_status'
            );

        if ($employeeId) {
            $travelsQuery->where('travels.employee_id', $employeeId);
        }

        $travels = $travelsQuery->get();

        return view('travels.index', compact('travels', 'employees', 'employeeId'));
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
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->arrival_date === $request->departure_date && $value <= $request->departure_time) {
                        $fail('De aankomsttijd moet later zijn dan de vertrektijd op dezelfde dag.');
                    }

                    $departureDateTime = Carbon::parse($request->departure_date . ' ' . $request->departure_time);
                    $arrivalDateTime = Carbon::parse($request->arrival_date . ' ' . $value);

                    if ($departureDateTime->diffInMinutes($arrivalDateTime) > 1440) {
                        $fail('Een reis mag maximaal 24 uur duren.');
                    }
                },
            ],
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
            DB::statement('CALL spCreateTravel(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->employee_id,
                $request->departure_id,
                $request->destination_id,
                $request->departure_date,
                $request->departure_time,
                $request->arrival_date,
                $request->arrival_time,
                $request->travel_status,
                1 
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
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->arrival_date === $request->departure_date && $value <= $request->departure_time) {
                        $fail('De aankomsttijd moet later zijn dan de vertrektijd op dezelfde dag.');
                    }

                    $departureDateTime = Carbon::parse($request->departure_date . ' ' . $request->departure_time);
                    $arrivalDateTime = Carbon::parse($request->arrival_date . ' ' . $value);

                    if ($departureDateTime->diffInMinutes($arrivalDateTime) > 1440) {
                        $fail('Een reis mag maximaal 24 uur duren.');
                    }
                },
            ],
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
            DB::statement('CALL spUpdateTravel(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $request->employee_id,
                $request->departure_id,
                $request->destination_id,
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

    public function destroy($id)
    {
        $travel = DB::table('travels')->where('id', $id)->first();

        if (!$travel) {
            return redirect()->route('travels.index')->with('error', 'Reis niet gevonden.');
        }

        if (in_array($travel->travel_status, ['Gepland', 'Uitgevoerd'])) {
            return redirect()->route('travels.index')->with('error', 'Reis met status "Gepland" of "Uitgevoerd" kan niet worden verwijderd.');
        }

        try {
            DB::table('travels')->where('id', $id)->delete();
            return redirect()->route('travels.index')->with('success', 'Reis succesvol verwijderd!');
        } catch (\Exception $e) {
            return redirect()->route('travels.index')->with('error', 'Fout bij het verwijderen van de reis: ' . $e->getMessage());
        }
    }
}