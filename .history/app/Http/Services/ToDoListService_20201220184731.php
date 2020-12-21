<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;

class ToDoListService
{

    public function createToDoList(User $user = null, Item $item)
    {
        return $this->add($item);
    }


    public function add(Item $item)
    {
        // if ($item->isValid() && checkPeriodBetweenTwoItems()) {
        // }
    }


    public function checkPeriodBetweenTwoItems()
    {
        $item =  Item::where('todolist_id', 5)->get(['id', 'created_at'])->first();

        return "le temps avant 30 minutes" . Carbon::now()->addMinutes(-30)->isAfter($item['created_at']);
    }
}
