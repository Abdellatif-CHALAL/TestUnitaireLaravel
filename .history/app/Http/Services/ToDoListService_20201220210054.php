<?php

namespace App\Http\Services;

use App\Mail\emailToUser;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;

class ToDoListService
{

    public function createToDoList(User $user, Item $item): bool
    {
        return $this->add($item) && $user->isValid();
        if ($this->getNumberOfItemsOfUser() === 8) {
            Mail::to($user->email)->send(new emailToUser());
        }
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
            throw new Exception("more 30 minutes if you want Add a new item !!");
        }
        return true;
    }

    public function getNumberOfItemsOfUser()
    {
        return count(Item::where('todolist_id', 5)->get(['id']));
    }
}
