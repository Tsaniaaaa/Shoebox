<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        return $categories;
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
        $table = category::create([
            "tittle" => $request->tittle
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
        $categories = category::find($id);
        if($categories) {
            return response()->json([
                'status' => 200,
                'data' => $categories
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
        $categories = category::find($id);
        if ($categories) {
            $categories->tittle = $request->tittle ? $request->tittle : $categories->tittle;
            $categories->save();
            return response()->json([
                'status' => 200,
                'data' => $categories
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
        $categories = category::where('id', $id)->first();
        if($categories){
            $categories->delete();
            return response()->json([
                'status' => 200,
                'data' => $categories
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id .' not found'
            ], 404);
        }
    }
}
