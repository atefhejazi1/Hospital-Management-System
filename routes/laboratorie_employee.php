<?php

use App\Http\Controllers\Dashboard_Laboratorie_Employee\DashboardController;
use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        //################################ dashboard doctor ########################################

        Route::get('/portal/laboratorie_employee', [DashboardController::class, 'index'])
            ->middleware(['auth:laboratorie_employee', 'verified'])
            ->name('dashboard.laboratorie_employee');
        //################################ end dashboard doctor #####################################

        Route::middleware(['auth:laboratorie_employee'])->group(function () {

            //############################# invoices route ##########################################
            Route::resource('invoices_laboratorie_employee', InvoiceController::class);
            Route::get('completed_invoices', [InvoiceController::class, 'completed_invoices'])->name('completed_invoices');
            Route::get('view_laboratories_laboratorie_employee/{id}', [InvoiceController::class, 'view_laboratories'])->name('view_laboratories_laboratorie_employee');
            //############################# end invoices route ######################################

        });



        //---------------------------------------------------------------------------------------------------------------
    }
);
