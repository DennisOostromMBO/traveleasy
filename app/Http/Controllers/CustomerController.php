<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                return stripos($customer->last_name, $search) !== false || 
                       stripos($customer->middle_name, $search) !== false || 
                       stripos($fullName, $search) !== false;
            });
        } else {
            $filteredCustomers = $customers;
        }

        // Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($filteredCustomers);

        // Define how many items we want to be visible in each page
        $perPage = 5;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generated links and append the search query
        $paginatedItems->setPath($request->url());
        $paginatedItems->appends(['search' => $search]); // Added this line

        return view('customers.index', [
            'customers' => $paginatedItems, 
            'search' => $search, 
            'tableEmpty' => false
        ]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        Log::info('Starting store request', ['data' => $request->all()]);

        // Validatie buiten try-catch zodat Laravel de errors automatisch kan doorsturen
        $validated = $request->validate([
            'first_name' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'middle_name' => 'nullable|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'date_of_birth' => 'required|date|after_or_equal:1900-01-01|before:today',
            'passport_details' => 'nullable|string|max:255',
            'street_name' => 'required|string|max:255|regex:/^[^\d]+$/',
            'house_number' => 'required|regex:/^\d+$/|digits_between:1,4',
            'addition' => 'nullable|string|max:8',
            'postal_code' => 'required|regex:/^[0-9]{4}[A-Z]{2}$/',
            'city' => 'required|string|max:255|regex:/^[^\d]+$/',
            'mobile' => 'required|regex:/^06\d{8}$/',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|not_regex:/xn--/'
        ], [
            // Naam validatie
            'first_name.required' => 'Voornaam is verplicht.',
            'first_name.max' => 'Voornaam is te lang.',
            'first_name.regex' => 'Voornaam is ongeldig.',

            'middle_name.max' => 'Tussenvoegsel is te lang.',
            'middle_name.regex' => 'Tussenvoegsel is ongeldig.',

            'last_name.required' => 'Achternaam is verplicht.',
            'last_name.max' => 'Achternaam is te lang.',
            'last_name.regex' => 'Achternaam is ongeldig.',

            // Geboortedatum validatie
            'date_of_birth.required' => 'Geboortedatum is verplicht.',
            'date_of_birth.date' => 'Geboortedatum is geen geldige datum.',
            'date_of_birth.after_or_equal' => 'Geboortedatum is niet geldig.',
            'date_of_birth.before' => 'Geboortedatum is niet geldig.',

            // Paspoort validatie
            'passport_details.max' => 'Paspoort details zijn te lang.',

            // Adres validatie
            'street_name.required' => 'Straatnaam is verplicht.',
            'street_name.max' => 'Straatnaam is te lang.',
            'street_name.regex' => 'Straatnaam is ongeldig.',

            'house_number.required' => 'Huisnummer is verplicht.',
            'house_number.regex' => 'Huisnummer mag alleen cijfers bevatten.',
            'house_number.digits_between' => 'Huisnummer is ongeldig.',

            'addition.max' => 'Toevoeging is niet geldig.',

            'postal_code.required' => 'Postcode is verplicht.',
            'postal_code.regex' => 'Postcode is ongeldig.',

            'city.required' => 'Plaats is verplicht.',
            'city.max' => 'Plaats is te lang.',
            'city.regex' => 'Plaats is ongeldig.',

            // Contact validatie
            'mobile.required' => 'Mobielnummer is verplicht.',
            'mobile.regex' => 'Mobielnummer is ongeldig.',

            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'E-mailadres is ongeldig.',
            'email.max' => 'E-mailadres is te lang.',
            'email.regex' => 'E-mailadres is ongeldig.',
            'email.not_regex' => 'E-mailadres is ongeldig.'
        ]);

        Log::info('Validation passed', ['validated' => $validated]);

        try {
            // Check voor dubbele email
            $emailExists = DB::table('contacts')
                ->where('email', $request->email)
                ->exists();

            if ($emailExists) {
                Log::warning('Duplicate email found', ['email' => $request->email]);
                return back()->withInput()->withErrors([
                    'email_exists' => 'Dit e-mailadres is al in gebruik door een andere klant!'
                ]);
            }

            // Check voor dubbel mobiel nummer
            $mobileExists = DB::table('contacts')
                ->where('mobile', $request->mobile)
                ->exists();

            if ($mobileExists) {
                Log::warning('Duplicate mobile found', ['mobile' => $request->mobile]);
                return back()->withInput()->withErrors([
                    'mobile_exists' => 'Dit mobiele nummer is al in gebruik door een andere klant!'
                ]);
            }

            Log::info('Calling spCreateCustomer stored procedure');
            $result = DB::select('CALL spCreateCustomer(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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

            Log::info('Store procedure completed', ['result' => $result]);

            return redirect()->route('customers.index')
                           ->with('success', 'Nieuwe klant succesvol toegevoegd.');

        } catch (\PDOException $e) {
            Log::error('Database error during customer creation', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'sql' => $e->getSql ?? 'No SQL available'
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error during customer creation', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                        ->with('error', 'Er is een fout opgetreden bij het toevoegen van de klant: ' . $e->getMessage());
        }
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
            'first_name' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'middle_name' => 'nullable|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'last_name' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'date_of_birth' => 'required|date|after_or_equal:1900-01-01|before:today',
            'passport_details' => 'nullable|string|max:255',
            'street_name' => 'required|string|max:255|regex:/^[^\d]+$/',
            'house_number' => 'required|regex:/^\d+$/|digits_between:1,4',
            'addition' => 'nullable|string|max:8',
            'postal_code' => 'required|regex:/^[0-9]{4}[A-Z]{2}$/',
            'city' => 'required|string|max:255|regex:/^[^\d]+$/',
            'mobile' => 'required|regex:/^06\d{8}$/',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|not_regex:/xn--/'
        ], [
            // Naam validatie
            'first_name.required' => 'Voornaam is verplicht.',
            'first_name.max' => 'Voornaam is te lang.',
            'first_name.regex' => 'Voornaam is ongeldig.',

            'middle_name.max' => 'Tussenvoegsel is te lang.',
            'middle_name.regex' => 'Tussenvoegsel is ongeldig.',

            'last_name.required' => 'Achternaam is verplicht.',
            'last_name.max' => 'Achternaam is te lang.',
            'last_name.regex' => 'Achternaam is ongeldig.',

            // Geboortedatum validatie
            'date_of_birth.required' => 'Geboortedatum is verplicht.',
            'date_of_birth.date' => 'Geboortedatum is geen geldige datum.',
            'date_of_birth.after_or_equal' => 'Geboortedatum is niet geldig.',
            'date_of_birth.before' => 'Geboortedatum is niet geldig.',

            // Paspoort validatie
            'passport_details.max' => 'Paspoort details zijn te lang.',

            // Adres validatie
            'street_name.required' => 'Straatnaam is verplicht.',
            'street_name.max' => 'Straatnaam is te lang.',
            'street_name.regex' => 'Straatnaam is ongeldig.',

            'house_number.required' => 'Huisnummer is verplicht.',
            'house_number.regex' => 'Huisnummer mag alleen cijfers bevatten.',
            'house_number.digits_between' => 'Huisnummer is ongeldig.',

            'addition.max' => 'Toevoeging is niet geldig.',

            'postal_code.required' => 'Postcode is verplicht.',
            'postal_code.regex' => 'Postcode is ongeldig.',

            'city.required' => 'Plaats is verplicht.',
            'city.max' => 'Plaats is te lang.',
            'city.regex' => 'Plaats is ongeldig.',

            // Contact validatie
            'mobile.required' => 'Mobielnummer is verplicht.',
            'mobile.regex' => 'Mobielnummer is ongeldig.',

            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'E-mailadres is ongeldig.',
            'email.max' => 'E-mailadres is te lang.',
            'email.regex' => 'E-mailadres is ongeldig.',
            'email.not_regex' => 'E-mailadres is ongeldig.'
        ]);

        try {
            // Check voor dubbele email
            $emailExists = DB::table('contacts')
                ->join('customers', 'contacts.customer_id', '=', 'customers.id')
                ->where('contacts.email', $request->email)
                ->where('customers.persons_id', '!=', $id)
                ->exists();

            if ($emailExists) {
                return back()->withInput()->withErrors([
                    'email_exists' => 'Dit e-mailadres is al in gebruik door een andere klant!'
                ]);
            }

            // Check voor dubbel mobiel nummer
            $mobileExists = DB::table('contacts')
                ->join('customers', 'contacts.customer_id', '=', 'customers.id')
                ->where('contacts.mobile', $request->mobile)
                ->where('customers.persons_id', '!=', $id)
                ->exists();

            if ($mobileExists) {
                return back()->withInput()->withErrors([
                    'mobile_exists' => 'Dit mobiele nummer is al in gebruik door een andere klant!'
                ]);
            }

            // Als beide checks OK zijn, update de klant
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