<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunicationController extends Controller
{
    public function index()
    {
        // Haal de berichten op via de stored procedure
        $messages = DB::select('CALL spGetAllMessages()');

        // Retourneer de view met de berichten
        return view('communications.index', ['messages' => $messages]);
    }

    public function create()
    {
        $customers = DB::select('CALL spGetAllCustomers()');
        return view('communications.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validate customer_id
            'employee_id' => 'required|exists:employees,id', // Validate employee_id
            'message' => 'required|string|max:1000', // Validate message
        ]);

        DB::table('communications')->insert([
            'customer_id' => $validated['customer_id'],
            'employee_id' => $validated['employee_id'],
            'message' => $validated['message'],
            'sent_date' => now(), // Automatically set the sent_date
            'is_active' => true, // Explicitly set is_active to true
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('communications.index')->with('success', 'Bericht succesvol toegevoegd.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $customers = DB::select('CALL spGetAllCustomers()');

        $filteredCustomers = array_filter($customers, function ($customer) use ($query) {
            return stripos($customer->full_name, $query) !== false;
        });

        return response()->json(array_values($filteredCustomers));
    }

    public function searchCustomers(Request $request)
    {
        $query = $request->input('query');

        // Join persons and customers to filter customers by first name
        $customers = DB::table('customers')
            ->join('persons', 'customers.persons_id', '=', 'persons.id')
            ->select('persons.id AS person_id', DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS full_name"))
            ->where('persons.first_name', 'LIKE', "$query%")
            ->get();

        return response()->json($customers);
    }

    public function searchEmployees(Request $request)
    {
        $query = $request->input('query');

        // Join persons and employees to filter employees by first name
        $employees = DB::table('employees')
            ->join('persons', 'employees.person_id', '=', 'persons.id')
            ->select('persons.id AS person_id', DB::raw("CONCAT(persons.first_name, ' ', persons.last_name) AS full_name"))
            ->where('persons.first_name', 'LIKE', "$query%")
            ->get();

        return response()->json($employees);
    }
}