<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()->load('person'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            // Call the stored procedure to update the user profile
            DB::statement('CALL spUpdateUserName(?, ?, ?, ?, ?)', [
                Auth::id(),
                $request->input('first_name'),
                $request->input('middle_name'),
                $request->input('last_name'),
                $request->input('email'),
            ]);

            return redirect()->route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            return back()->withInput()
                        ->with('error', 'Er is een fout opgetreden bij het bijwerken van de profielgegevens.');
        }
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => __('The provided password does not match your current password.')]);
        }

        // Call the stored procedure to update the user password
        DB::statement('CALL spUpdateUserPassword(?, ?)', [
            Auth::id(),
            Hash::make($request->password),
        ]);

        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        // Check if the password is correct
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => __('The provided password does not match your current password.')]);
        }

        try {
            // Controleer of de gebruiker de enige administrator is
            $adminCount = DB::table('users')
                ->where('role_id', 1) 
                ->count();

            if ($adminCount === 1 && Auth::user()->role_id === 1) {
                // Flash een foutmelding naar de sessie
                return back()->with('error', 'Je kunt je account niet verwijderen omdat je de enige administrator bent.');
            }

            // Call the stored procedure to delete the user
            DB::statement('CALL spDeleteUser(?)', [
                Auth::id(),
            ]);

            Auth::logout();

            return redirect('/')->with('status', 'Account succesvol verwijderd.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '45000') {
                return back()->with('error', 'Kan account niet verwijderen: er moet minimaal één administrator zijn.');
            }

            return back()->with('error', 'Er is een fout opgetreden bij het verwijderen van je account.');
        }
    }
}
