<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getCartPrice(Request $request)
    {
        $user_orders = Order::where('user_id', $request->user_id)->where('order_completed',0)->get();
        $total_user_cart = $user_orders->sum('price');
        return $total_user_cart;
    }

    public function completePurchases(Request $request)
    {
        Order::where('user_id', $request->user_id)->update(['order_completed'=>1]);
        return 1;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return $orders;
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        if(isset($request['price']) && isset($request['user_id'])){
            $order->price = $request->price;
            $order->order_completed = 0;
            $order->user_id = $request->user_id;
            $order->save();
            return true;
        }
        return false;
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    }
}
