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
      $item =  Item::all()->first();
      $item->created_at;
      return
    }
}
