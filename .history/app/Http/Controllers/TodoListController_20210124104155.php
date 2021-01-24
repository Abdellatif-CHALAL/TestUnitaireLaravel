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
        return Carbon::now()->diffInMinutes(Carbon::now()->addMinutes(30));
        try {
            return response()->json($this->toDoListService->createToDoList($user, $request->description), 201);
        } catch (Exception $e) {
            return response()->json(["message" => '422 Unprocessable Entity :' . $e->getMessage()], 422);
        }
    }



    public function storeItem(Item $item, User $user)
    {

        // if (!$this->toDoListService->addItemToTodolist($user, $item)) {
        //     throw new Exception('Item has not been added');
        // }

        return response()->json(Item::where('todolist_id', 5)->get(['id', 'todolist_id', 'name', 'content', 'created_at']), 200);
    }
}
