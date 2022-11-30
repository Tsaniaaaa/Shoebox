<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\shoes;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = transactions::all();
        return $transaction;
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
        $product = shoes::find($request->id);
        $product_price = $product->price;
        $total_price = $product_price * $request->amount;
        if ($request->amount != 0) {
          $table = transactions::create([
            "name" => $product->name,
            "amount" => $request->amount,
            "price" => $product_price,
            "total" => $total_price,
            "voucher" => $request->voucher,
            "payment_method" => $request->payment_method
        ]);  
        } else {
           return response()->json([
            'status' => 400,
            'message' => 'Amount cant be 0'
        ], 400); 
        }

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
        $transaction = transactions::find($id);
        if($transaction) {
            return response()->json([
                'status' => 200,
                'data' => $transaction
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
