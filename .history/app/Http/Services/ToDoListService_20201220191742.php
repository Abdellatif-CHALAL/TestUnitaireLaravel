<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class ToDoListService
{

    public function createToDoList(User $user = null, Item $item): bool
    {
        return $this->add($item);
    }


    public function add(Item $item): bool
    {
        if ($item->isValid() && $this->checkPeriodBetweenTwoItems()) {
            $item->todolist_id = 5;
            $item->save();
            return true;
        }
    }


    public function checkPeriodBetweenTwoItems(): bool
    {
        $item =  Item::where('todolist_id', 5)->get(['id', 'created_at'])->first();
        if (!Carbon::now()->addMinutes(-30)->isAfter($item['created_at'])) {
            throw new Exception("less 30 minutes for Adding a new item ");
        }
        return true;
    }
}
