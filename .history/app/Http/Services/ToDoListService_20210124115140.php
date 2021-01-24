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

}
