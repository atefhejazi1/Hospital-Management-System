<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('Dashboard.User.auth.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        if (Auth::guard('web')) {
            return redirect()->intended('/dashboard/user');
        } elseif (Auth::guard('admin')) {
            return redirect()->intended('/dashboard/admin');
        } elseif (Auth::guard('doctor')) {
            return redirect()->intended('/dashboard/doctor');
        } elseif (Auth::guard('laboratorie_employee')) {
            return redirect()->intended('/dashboard/laboratorie_employee');
        } elseif (Auth::guard('ray_employee')) {
            return redirect()->intended('/dashboard/ray_employee');
        } elseif (Auth::guard('patient')) {
            return redirect()->intended('/dashboard/patient');
        }


        return redirect()->back()->withErrors(['name' => (trans('Dashboard/auth.failed'))]);
        // return redirect()->intended(route('dashboard.user', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
