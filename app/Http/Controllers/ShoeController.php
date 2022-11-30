<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shoes;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoes = shoes::all();        
        return $shoes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = shoes::create([
            "name" => $request->name,
            "colour" => $request->colour,
            "description" => $request-> description,
            "size" => $request->size,
            "price" => $request->price
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'Data Added',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shoes = shoes::find($id);
        if($shoes) {
            return response()->json([
                'status' => 200,
                'data' => $shoes
            ], 200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'The id number ' . $id . 'not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shoes = shoes::find($id);
        if ($shoes) {
            $shoes->name = $request->name ? $request->name : $shoes->name;
            $shoes->colour = $request->colour ? $request->colour : $shoes->colour;
            $shoes->description = $request->description ? $request->description : $shoes->description;
            $shoes->size = $request->size ? $request->size : $shoes->size;
            $shoes->price = $request->price ? $request->price : $shoes->price;
            $shoes->save();
            return response()->json([
                'status' => 200,
                'data' => $shoes
            ], 200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => $id . ' not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shoes = shoes::where('id', $id)->first();
        if($shoes){
            $shoes->delete();
            return response()->json([
                'status' => 200,
                'data' => $shoes
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' not found'
            ], 404);
        }
    }
}
