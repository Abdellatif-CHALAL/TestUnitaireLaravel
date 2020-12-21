<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Item::all(), 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Item::find($id), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TodoList $todoList)
    {
        $rules = [
            'name' => 'unique:items',
        ];

        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $rules;
        }

        $item = Item::create([
            'name' => $request->name,
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
        ]);


        return response()->json($item, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return response()->json(Item::all(), 201);
    }
}
