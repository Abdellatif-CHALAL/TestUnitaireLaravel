<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Models\User;

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
        // $item->created_at;
        return $item['created_at'];
    }
}
