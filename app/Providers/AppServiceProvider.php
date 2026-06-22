<?php

namespace App\Providers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Guards checked, in priority order, when Gate/Policy code (Gate::allows,
     * $this->authorize(), @can) asks "who is the current user?". Laravel's
     * default Gate only ever asks the "web" guard, which this app never
     * authenticates against — every guard (admin/doctor/patient/employee) is
     * a separate session, and exactly one is logged in at a time. Without
     * this override, every authorize() call would see a guest and reject.
     */
    private const AUTH_GUARDS = ['admin', 'doctor', 'patient', 'ray_employee', 'laboratorie_employee'];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GateContract::class, function ($app) {
            return new Gate($app, function () {
                foreach (self::AUTH_GUARDS as $guard) {
                    if ($user = Auth::guard($guard)->user()) {
                        return $user;
                    }
                }

                return null;
            });
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
