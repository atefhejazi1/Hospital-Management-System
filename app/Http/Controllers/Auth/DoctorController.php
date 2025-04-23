<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DoctorLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    public function store(DoctorLoginRequest $request)
    {
        // التحقق من المصادقة
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard.doctor', absolute: false));

        // إذا فشلت المصادقة، أرجع رسالة خطأ
        // return redirect()->back()->withErrors([
        //     'name' => trans('Dashboard/auth.failed')
        // ]);
    }


    public function destroy(Request $request)
    {

        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
