<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LaboratorieEmployeeLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratorieEmployeeController extends Controller
{
    public function store(LaboratorieEmployeeLoginRequest $request)
    {
        // التحقق من المصادقة
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard.laboratorie_employee', absolute: false));

        // إذا فشلت المصادقة، أرجع رسالة خطأ
        // return redirect()->back()->withErrors([
        //     'name' => trans('Dashboard/auth.failed')
        // ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('laboratorie_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
