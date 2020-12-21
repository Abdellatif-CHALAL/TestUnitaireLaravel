<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class ToDoListService
{

    public function createToDoList(User $user, Item $item)
    {
        return $this->add($item);
    }


    public function add(Item $item)
    {
        if ($item->isValid() && $this->checkPeriodBetweenTwoItems()) {
            $item->todolist_id = 5;
            return true;
        }
    }


    public function checkPeriodBetweenTwoItems()
    {
        $item =  Item::where('todolist_id', 5)->get(['id', 'created_at'])->first();
        if (!Carbon::now()->addMinutes(-30)->isAfter($item['created_at'])) {
            throw new Exception("less 30 minutes for Adding a new item ");
        }
        return true;
    }
}
