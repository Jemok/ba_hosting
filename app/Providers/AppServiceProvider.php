<?php

namespace Md\Providers;

use Event;
use Md\Message;
use Md\Chat;
use Md\Events\ItemCreated;
use Md\Events\ItemUpdated;
use Md\Events\ItemDeleted;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Message::created(function ($message) {
            Event::fire(new ItemCreated($message));
        });

        Chat::updated(function ($item) {
            Event::fire(new ItemUpdated($item));
        });

        Chat::deleted(function ($item) {
            Event::fire(new ItemDeleted($item));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
