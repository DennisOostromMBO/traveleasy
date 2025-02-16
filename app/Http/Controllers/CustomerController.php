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
                return stripos($customer->last_name, $search) !== false;
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
}