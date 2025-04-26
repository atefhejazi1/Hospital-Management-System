<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\InvoicesController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
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

                //############################# completed_invoices route ##########################################
                Route::get('completed_invoices', [InvoicesController::class, 'completedInvoices'])->name('completedInvoices');
                //############################# end invoices route ################################################

                //############################# review_invoices route ##########################################
                Route::get('review_invoices', [InvoicesController::class, 'reviewInvoices'])->name('reviewInvoices');
                //############################# end invoices route #############################################

                //############################# invoices route ##########################################
                Route::resource('invoices', InvoicesController::class);
                //############################# end invoices route ######################################


                //############################# review_invoices route ##########################################
                Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');
                //############################# end invoices route #############################################


                //############################# Diagnostics route ##########################################

                Route::resource('Diagnostics', DiagnosticController::class);

                //############################# end Diagnostics route ######################################

                //############################# rays route ##########################################

                Route::resource('rays', RayController::class);

                //############################# end rays route ######################################


                //############################# Laboratories route ##########################################

                Route::resource('Laboratories', LaboratorieController::class);
                Route::get('show_laboratorie/{id}', [InvoicesController::class, 'showLaboratorie'])->name('show.laboratorie');

                //############################# end Laboratories route ######################################


                //############################# rays route ##########################################

                Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('patient_details');

                //############################# end rays route ######################################
                Route::get('/404', function () {
                    return view('Dashboard.404');
                })->name('404');
            });
        });



        require __DIR__ . '/auth.php';
    }
);
