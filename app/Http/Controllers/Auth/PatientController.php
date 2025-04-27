<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PatientLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function store(PatientLoginRequest  $request)
    {
        // التحقق من المصادقة
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard.patient', absolute: false));

        // إذا فشلت المصادقة، أرجع رسالة خطأ
        // return redirect()->back()->withErrors([
        //     'name' => trans('Dashboard/auth.failed')
        // ]);
    }


    public function destroy(Request $request)
    {

        Auth::guard('patient')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
