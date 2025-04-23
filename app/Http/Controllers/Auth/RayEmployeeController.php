<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\reyEmpLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeController extends Controller
{

    public function store(reyEmpLoginRequest $request)
    {
        // التحقق من المصادقة
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard.ray_employee', absolute: false));

        // إذا فشلت المصادقة، أرجع رسالة خطأ
        // return redirect()->back()->withErrors([
        //     'name' => trans('Dashboard/auth.failed')
        // ]);
    }


    public function destroy(Request $request)
    {

        Auth::guard('ray_employee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
