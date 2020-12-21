<?php

namespace App\Http\Services;

use App\Models\Item;
use App\Models\User;

class ToDoListService
{

    public function createToDoList(User $user, Item $item)
    {
        return $this->add($item);
    }


    public function add(Item $item)
    {
        return $item;
    }
}