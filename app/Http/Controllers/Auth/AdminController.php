<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function store(AdminLoginRequest $request)
    {
        // التحقق من المصادقة
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard.admin', absolute: false));

        // إذا فشلت المصادقة، أرجع رسالة خطأ
        // return redirect()->back()->withErrors([
        //     'name' => trans('Dashboard/auth.failed')
        // ]);
    }


    public function destroy(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
