<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountOverviewController extends Controller
{
    /**
     * Display the account overview.
     */
    public function index(Request $request)
    {
        $sortRole = $request->input('sort_role', '');

        // Call the stored procedure to get users
        $users = DB::select('CALL spGetAllUsers()');

        // Call the stored procedure to get roles
        $roles = DB::select('CALL spGetAllRoles()');

        // Filter users by role if a role is selected
        if ($sortRole) {
            $users = collect($users)->filter(function ($user) use ($sortRole) {
                return $user->role_name == $sortRole;
            })->values()->all();
        }

        // Paginate the results manually
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($users, ($currentPage - 1) * $perPage, $perPage);
        $paginatedUsers = new LengthAwarePaginator($currentItems, count($users), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        return view('accountOverview.index', compact('paginatedUsers', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('person')->findOrFail($id);
        $roles = Rol::all();

        return view('accountOverview.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|integer',
            'is_active' => 'required|boolean',
            'comments' => 'nullable|string',
        ]);

        DB::statement('CALL spUpdateUser(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->input('first_name'),
            $request->input('middle_name'),
            $request->input('last_name'),
            $request->input('email'),
            $request->input('role'),
            $request->input('is_active'),
            $request->input('comments')
        ]);

        return redirect()->route('account.overview')->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('account.overview')->with('success', 'Account deleted successfully.');
    }
}