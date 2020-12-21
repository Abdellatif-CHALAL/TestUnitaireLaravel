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
        Table::where('id', 1)->get(['name', 'surname']);
        $item =  Item::where('todolist_id', 5)->get(['id']);
        // $item->created_at;
        return $item;
    }
}
