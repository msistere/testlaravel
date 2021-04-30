<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Muestra el calendario de pedidos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Muestra el formulario de pedidos
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request)
    {
        
        $dateorder = $request->dateorder;
        $products = Product::whereHas('prices', function (Builder $query) use ($dateorder) {
            $query->where('from', '<=', date('Y-m-d', strtotime($dateorder)));
            $query->where('to', '>=', date('Y-m-d', strtotime($dateorder)));
        })->orderBy('name', 'asc')->get();
        
        Log::debug($products);
        
        return view('admin.orders.create', compact('products', 'dateorder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
