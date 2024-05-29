<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function showUserLoginForm()
    {
        return view('UserLogin.index');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('client')->attempt($credentials)) {

            return redirect('/SuiviCommande');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    /*public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }*/

    /**
     * Destroy an authenticated session.
     */


    public function deconnect(Request $request): RedirectResponse
    {

        Auth::guard('client')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }



}
