<?php

namespace App\Http\Services;

use App\Mail\emailToUser;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;

class ToDoListService
{
    public int $todolist_id = 1;

    public function createToDoList(User $user, Item $item): bool
    {
        return $this->add($item) && $user->isValid();
    }


    public function add(Item $item): bool
    {

        if (is_null($item)) {
            throw new Exception("Item is null");
        }
        if ($this->getNumberOfItemsOfUser() > 10) {
            throw new Exception("You have too many items !!");
        }
        // if ($item->isValid() && $this->checkPeriodBetweenTwoItems($this->getLastItem())) {
        //     $item->todolist_id = $this->todolist_id;
        //     $item->save();
        //     if ($this->getNumberOfItemsOfUser() === 8) {
        //         Mail::to($this->getEmailUser())->send(new emailToUser());
        //     }
        // }
        return true;
    }

    // && 

    public function getLastItem(): Item
    {
        return Item::where('todolist_id', $this->todolist_id)->get(['id', 'created_at'])->first();
    }
    public function checkPeriodBetweenTwoItems(Item $item): bool
    {
        if (!Carbon::now()->addMinutes(-30)->isAfter($item['created_at'])) {
            throw new Exception("more 30 minutes if you want Add a new item !!");
        }
        return true;
    }

    public function getNumberOfItemsOfUser()
    {
        return count(Item::where('todolist_id', $this->todolist_id)->get(['id']));
    }

    public function getEmailUser()
    {
        return User::find(TodoList::find($this->todolist_id)->user_id)->email;
    }
}
