<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Orderline;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Flash;
use Redirect;
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
        
        return view('admin.orders.create', compact('products', 'dateorder'));
    }

    /**
     * Almacena un pedido en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            DB::beginTransaction();
            
            $validator = \Validator::make($request->all(), [
                'dateorder' => 'required|date',
                'product_id' => 'required|exists:products,id',
                'units' => 'required|numeric',
            ]);
            
            if (!$validator->fails()) {
                $order = new Order();
                $order->dateorder = $request->dateorder;
                $order->save();
                
                $line = new Orderline();
                $line->order_id = $order->id;
                $line->product_id = $request->product_id;
                $line->units = $request->units;
                $line->save();
                
                DB::commit();
                
                return Redirect::route('pedidos.index')->with('success', __('El pedido se ha guardado correctamente.'));
            }
            DB::rollBack();
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al guardar el pedido.");
            DB::rollBack();
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
            
    }

    /**
     * Muestra los datos de un pedido
     *
     * @param  \App\Models\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Order $pedido)
    {
        return view('admin.orders.show', compact('pedido'));
    }

    /**
     * Muestra el formulario de edición del pedido
     *
     * @param  \App\Models\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $pedido)
    {
        $products = Product::whereHas('prices', function (Builder $query) use ($pedido) {
            $query->where('from', '<=', date('Y-m-d', strtotime($pedido->dateorder)));
            $query->where('to', '>=', date('Y-m-d', strtotime($pedido->dateorder)));
        })->orderBy('name', 'asc')->get();
        
        return view('admin.orders.edit', compact('pedido', 'products'));
    }

    /**
     * Modifica una pedido
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $pedido)
    {
        try {
            
            DB::beginTransaction();
            
            $validator = \Validator::make($request->all(), [
                'dateorder' => 'required|date',
                'product_id' => 'required|exists:products,id',
                'units' => 'required|numeric',
            ]);
            
            if (!$validator->fails()) {
                
                //Primero elimino las lineas de ese pedido
                $pedido->orderlines()->delete();
                
                //Creo una nueva línea
                $line = new Orderline();
                $line->order_id = $pedido->id;
                $line->product_id = $request->product_id;
                $line->units = $request->units;
                $line->save();
                
                DB::commit();
                
                return Redirect::route('pedidos.index')->with('success', __('El pedido se ha modificado correctamente.'));
            }
            DB::rollBack();
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al modificar el pedido.");
            DB::rollBack();
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Elimina el pedido indicado
     *
     * @param  \App\Models\Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $pedido)
    {
        try {
            
            DB::beginTransaction();
            
            //Eliminamos las líneas del pedido
            $pedido->orderlines()->delete();
            $pedido->delete();
            
            DB::commit();
            
        } catch (\Exception $ex) {
            DB::rollBack();
            $error = __('Se ha producido un error al intentar eliminar el pedido.');
            Log::error($ex);
            return Redirect::route('pedidos.index')->with('error', $error);
        }
        
        // Redirect to the group management page
        return redirect(route('pedidos.index'))->with('success', __('Pedido eliminado correctamente.'));
    }
}
