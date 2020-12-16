<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id), 200);
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
            'fist_name' => 'required',
            'last_name' => 'required',
            'date_naissance' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8||max:40',
        ];

        // $this->validate($request, $rules);
        $this->validate($request, $rules);

        $data = $request->all();
        $user = User::create($data);

        return response()->json($user, 201);
    }
}
