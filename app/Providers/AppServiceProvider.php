<?php

namespace App\Providers;

use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        date_default_timezone_set("Africa/Cairo");
        User::created(function ($user){
            Mail::to($user)->send(new WelcomeUserMail($user));
        });
    }
}
