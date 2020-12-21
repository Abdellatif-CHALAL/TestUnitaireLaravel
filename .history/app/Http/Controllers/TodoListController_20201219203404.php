<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
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
        $rules = [
            'date_naissance' => 'required',
            'email' => 'unique:users',

        ];
        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $rules;
        }
        $todo_list = new TodoList();
        $user->first_name = $request->first_name;;
        $user->isValid();
        $user->save();

        return response()->json($user, 201);
    }
}
