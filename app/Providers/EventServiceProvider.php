<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\IotBot' => [
            'App\Listeners\IotBotNotification'
        ],

        // 'App\Events\IotBotFriend' => [
        //     'App\Listeners\IotBotFriendNotification'
        // ],

        // 'App\Events\IotBotGroup' => [
        //     'App\Listeners\IotBotGroupNotification'
        // ],
    ];

    protected $subscribe = [
        'App\Listeners\IotBotEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
