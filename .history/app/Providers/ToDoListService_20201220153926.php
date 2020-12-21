<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ToDoListService extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    public function test()
    {
        return "je suis dans le service provider";
    }


    public function add(User $user, Item $item)
    {
        if ($item->isValid() && $user->isValid()) {
            return true;
        }
        return false;
    }
}
