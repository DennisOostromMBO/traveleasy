<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->input('sort_role'));
            });
        }

        $users = $query->paginate(5);

        // Haal alle rollen op voor de sorteeropties
        $roles = DB::select('CALL spGetAllRoles()');

        return view('accountOverview.index', compact('users', 'roles'));
    }
}