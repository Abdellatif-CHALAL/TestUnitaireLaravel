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

    public function createToDoList(User $user, string $description): TodoList
    {
        if (is_null($user)) {
            throw new Exception("User connot be null");
        }
        try {
            $user->isValid();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $user->todolist()->create([
            "description" => $description
        ]);
        return $user->todolist;
    }

    public function canAddItemToTodolist(User $user, Item $item)
    {
        if (is_null($user)) {
            throw new Exception("User connot be null");
        }
        try {
            $user->isValid();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if (is_null($item)) {
            throw new Exception("Item connot be null");
        }
        try {
            $item->isValid();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        foreach ($user->todolist->item as $todolistItem) {
            if ($todolistItem->name === $item->name) {
                throw new Exception("Name item already exist");
            }
        }

        if (!$user->todolist->checkPeriodBetweenTwoItems($item)) {
            throw new Exception("more 30 minutes if you want add a new item !!");
        }

        if ($user->todolist->getNumberOfItemsOfUser() >= 10) {
            throw new Exception("You have too many items !!");
        }

        if ($user->todolist->getNumberOfItemsOfUser() === 8) {
            Mail::to($user->email)->send(new emailToUser());
        }

        

    // public function add(Item $item): bool
    // {

    //     if (is_null($item)) {
    //         throw new Exception("Item is null");
    //     }

    //     try {
    //         $item->isValid();
    //     } catch (Exception $e) {
    //         throw new Exception($e->getMessage());
    //     }

    //     if ($this->getNumberOfItemsOfUser() >= 10) {
    //         throw new Exception("You have too many items !!");
    //     }






    //     if ($item->isValid() && $this->checkPeriodBetweenTwoItems($this->getLastItem())) {
    //         $item->todolist_id = $this->todolist_id;
    //         $this->saveItemInDataBase($item);
    //         if ($this->getNumberOfItemsOfUser() === 8) {
    //             $this->sendEmailToUser();
    //         }
    //     }
    //     return true;
    // }


    // public function sendEmailToUser(): bool
    // {
    //     return Mail::to($this->getEmailUser())->send(new emailToUser());
    // }


    // public function saveItemInDataBase($item): bool
    // {
    //     return $item->save();
    // }


    // // public function getLastItem(): Item
    // // {
    // //     return Item::where('todolist_id', $this->todolist_id)->get(['id', 'created_at'])->first();
    // // }


    // // public function checkPeriodBetweenTwoItems(Item $item): bool
    // // {
    // //     if (!Carbon::now()->addMinutes(-30)->isAfter($item['created_at'])) {
    // //         throw new Exception("more 30 minutes if you want Add a new item !!");
    // //     }
    // //     return true;
    // // }

    // // public function getNumberOfItemsOfUser()
    // // {
    // //     return count(Item::where('todolist_id', $this->todolist_id)->get(['id']));
    // // }

    // public function getEmailUser(): string
    // {
    //     return User::find(TodoList::find($this->todolist_id)->user_id)->email;
    // }
}
