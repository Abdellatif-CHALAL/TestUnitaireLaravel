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

    public function createToDoList(User $user, string $decription): TodoList
    {
        if (is_null($user)) {
            return response()->json(["message" => "User connot be null"], 422);
        }
        try {
            $user->isValid();
        } catch (Exception $e) {
            return response()->json(["message" => 'Unprocessable Entity' . $e->getMessage()], 422);
        }

        $todolist = new TodoList();
        $todolist->user_id = $user->id;
        $todolist->description = $request->description;
        $todolist->save();
        return $todolist
    }


    public function add(Item $item): bool
    {

        if (is_null($item)) {
            throw new Exception("Item is null");
        }
        if ($this->getNumberOfItemsOfUser() >= 10) {
            throw new Exception("You have too many items !!");
        }
        if ($item->isValid() && $this->checkPeriodBetweenTwoItems($this->getLastItem())) {
            $item->todolist_id = $this->todolist_id;
            $this->saveItemInDataBase($item);
            if ($this->getNumberOfItemsOfUser() === 8) {
                $this->sendEmailToUser();
            }
        }
        return true;
    }


    public function sendEmailToUser(): bool
    {
        return Mail::to($this->getEmailUser())->send(new emailToUser());
    }


    public function saveItemInDataBase($item): bool
    {
        return $item->save();
    }


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
