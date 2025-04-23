<?php

use App\Http\Controllers\Dashboard_Doctor\InvoicesController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // ############################# Doctor Dashboard route ##########################################
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.Doctor.dashboard');
        })->middleware(['auth:doctor', 'verified'])->name('dashboard.doctor');




        Route::middleware(['auth:doctor'])->group(function () {
            Route::prefix('doctor')->group(function () {

                //############################# invoices route ##########################################
                Route::resource('invoices', InvoicesController::class);
                //############################# end invoices route ######################################


            });
        });



        require __DIR__ . '/auth.php';
    }
);
