<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $customers = DB::select('CALL spGetAllCustomers()');

        if (empty($customers)) {
            return view('customers.index', ['customers' => collect(), 'search' => $search, 'tableEmpty' => true]);
        }

        if ($search) {
            $filteredCustomers = array_filter($customers, function($customer) use ($search) {
                $fullName = trim($customer->middle_name . ' ' . $customer->last_name);
                return stripos($customer->last_name, $search) !== false || stripos($customer->middle_name, $search) !== false || stripos($fullName, $search) !== false;
            });
        } else {
            $filteredCustomers = $customers;
        }

        // Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($filteredCustomers);

        // Define how many items we want to be visible in each page
        $perPage = 10;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generated links
        $paginatedItems->setPath($request->url());

        return view('customers.index', ['customers' => $paginatedItems, 'search' => $search, 'tableEmpty' => false]);
    }

    public function edit($id)
    {
        $customer = collect(DB::select('CALL spGetCustomerById(?)', [$id]))->first();
        
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Klant niet gevonden.');
        }

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'passport_details' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'addition' => 'nullable|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255'
        ]);

        try {
            DB::select('CALL spUpdateCustomer(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $request->first_name,
                $request->middle_name,
                $request->last_name,
                $request->date_of_birth,
                $request->passport_details,
                $request->street_name,
                $request->house_number,
                $request->addition,
                $request->postal_code,
                $request->city,
                $request->mobile,
                $request->email
            ]);

            return redirect()->route('customers.index')
                           ->with('success', 'Klantgegevens succesvol bijgewerkt.');
        } catch (\Exception $e) {
            return back()->withInput()
                        ->with('error', 'Er is een fout opgetreden bij het bijwerken van de klantgegevens.');
        }
    }
}