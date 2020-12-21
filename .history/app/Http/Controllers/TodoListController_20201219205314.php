<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
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
    public function store(Request $request)
    {
        $rules = [];
        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $rules;
        }
        $todo_list = new TodoList();
        $todo_list->description = "description";
        $todo_list->user_id = 1;
        $todo_list->save();

        // $todo_list = TodoList::create([
        //     'description' => "description teste unitaire",
        //     'user_id' => 1,
        // ]);
        return response()->json($todo_list, 201);
    }
}
