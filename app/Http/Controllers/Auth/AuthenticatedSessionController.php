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

        // Check which guard is authenticated and redirect accordingly
        if (Auth::guard('admin')->check()) {
            return redirect()->intended(route('dashboard.admin', absolute: false));
        } elseif (Auth::guard('doctor')->check()) {
            return redirect()->intended(route('dashboard.doctor', absolute: false));
        } elseif (Auth::guard('patient')->check()) {
            return redirect()->intended(route('dashboard.patient', absolute: false));
        } elseif (Auth::guard('ray_employee')->check()) {
            return redirect()->intended(route('dashboard.ray_employee', absolute: false));
        } elseif (Auth::guard('laboratorie_employee')->check()) {
            return redirect()->intended(route('dashboard.laboratorie_employee', absolute: false));
        } elseif (Auth::guard('web')->check()) {
            return redirect()->intended(route('dashboard.user', absolute: false));
        }

        // Fallback if no guard is authenticated
        return redirect()->back()->withErrors([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout from all possible guards
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('doctor')->logout();
        Auth::guard('patient')->logout();
        Auth::guard('ray_employee')->logout();
        Auth::guard('laboratorie_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
