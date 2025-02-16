<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;

class AccountOverviewController extends Controller
{
    /**
     * Display the account overview.
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        // Zoek op e-mail
        if ($request->has('search')) {
            $query->where('email', 'like', '%' . $request->input('search') . '%');
        }

        // Sorteer op rol naam
        if ($request->has('sort_role') && $request->input('sort_role') != '') {
            $query->join('roles', 'users.role_id', '=', 'roles.id')
                  ->orderBy('roles.name', $request->input('sort_role'))
                  ->select('users.*');
        }

        $users = $query->paginate(5);

        // Haal alle rollen op voor de sorteeropties
        $roles = Rol::all();

        return view('accountOverview.index', compact('users', 'roles'));
    }
}