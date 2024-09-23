<?php

use Illuminate\Auth\Events\Login;
use App\Listeners\LogUserLogin;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogUserLogin::class,
        ],
    ];
}
