<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use App\Providers\ToDoListService;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    // public $toDoListService;
    // public function __construct(ToDoListService $toDoListService)
    // {
    //     $this->toDoListService = $toDoListService;
    // }
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
    public function store(Request $request, ToDoListService $toDoListService)
    {
        $rules = [];
        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $rules;
        }
        return $this->toDoListService->test();

        $todo_list = new TodoList();
        $todo_list->description = "description";
        $todo_list->user_id = 1;
        $todo_list->save();

        return response()->json($todo_list, 201);
    }
}
