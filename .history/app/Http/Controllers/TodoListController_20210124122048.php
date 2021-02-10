<?php

namespace App\Http\Controllers;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public $toDoListService;
    public function __construct()
    {
        $this->toDoListService = new ToDoListService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TodoList::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        try {
            return response()->json($this->toDoListService->createToDoList($user, $request->description), 201);
        } catch (Exception $e) {
            return response()->json(["message" => '422 Unprocessable Entity :' . $e->getMessage()], 422);
        }
    }



    public function storeItem(User $user, Item $item)
    {
        try {
            $this->toDoListService->add($user, $item);
        } catch (Exception $e) {
            return response()->json(["message" => '422 Unprocessable Entity :' . $e->getMessage()], 422);
        }
        $user->todolist->items()->create([
            "todo_list_id" => $user->todolist->id;
        ]);
        return response()->json($user->todolist->items(), 201);
    }
}
