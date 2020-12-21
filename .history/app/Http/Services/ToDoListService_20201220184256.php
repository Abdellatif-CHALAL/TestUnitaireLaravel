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
        Carbon::now()->addYears(-13)->isAfter($this->date_naissance)
        return $item['created_at'];
    }
}
