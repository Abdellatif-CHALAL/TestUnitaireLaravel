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
            return response()->json(["message" => $e->getMessage()], 422);
        }
    }

    public function storeItem(User $user, Request $request)
    {
        return $this->user->todolist->items;
        $item  = new Item();
        $item->name = $request->name;
        $item->content = $request->content;
        $item->created_at = Carbon::now();
        try {
            $user->todolist->items[] = $this->toDoListService->add($user, $item);
            return response()->json($user->todolist->items, 201);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 422);
        }
    }
}
