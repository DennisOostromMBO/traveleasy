<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountOverviewController extends Controller
{
    /**
     * Display the account overview.
     */
    public function index()
    {
        $users = User::with('role')->paginate(5); // Gebruik paginatie
        return view('AccountOverview.index', compact('users'));
    }
}
