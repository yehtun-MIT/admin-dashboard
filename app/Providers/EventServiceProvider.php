<?php

namespace App\Providers;

use App\Events\AutoLogoutEvent;
use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use App\Listeners\AutoLogoutListener;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginEvent::class =>[
            LoginListener::class,
        ],
        LogoutEvent::class => [
            LogoutListener::class,
        ],
        AutoLogoutEvent::class => [
            AutoLogoutListener::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
