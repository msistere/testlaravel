<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Redirect;
use Illuminate\Support\Facades\Log;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Muestra el formulario de alta de tarifa de un producto
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $producto)
    {
        return view('admin.products.prices.create', compact('producto'));
    }

    /**
     * Almacena en base de datos una tarifa del producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $validator = \Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'from' => 'required|date',
                'to' => 'required|date',
                'price' => 'required|numeric',
            ]);
            
            if (!$validator->fails()) {
                $price = new Price();
                $price->product_id = $request->product_id;
                $price->from = $request->from;
                $price->to = $request->to;
                $price->price = $request->price;
                $price->save();
                
                return Redirect::route('productos.edit', ['producto' => $request->product_id])->with('success', __('La tarifa se ha guardado correctamente.'));
            }
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al guardar la tarifa.");
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Muestra el formulario de edición de un precio
     *
     * @param  \App\Models\Price  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $producto, Price $tarifa)
    {
        return view('admin.products.prices.edit', compact('producto', 'tarifa'));
    }

    /**
     * Edita el formulario de una tarifa de un producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $producto, Price $tarifa)
    {
        try {
            
            $validator = \Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'from' => 'required|date',
                'to' => 'required|date',
                'price' => 'required|numeric',
            ]);
            
            if (!$validator->fails()) {
                $tarifa->from = $request->from;
                $tarifa->to = $request->to;
                $tarifa->price = $request->price;
                $tarifa->save();
                
                return Redirect::route('productos.edit', ['producto' => $tarifa->product_id])->with('success', __('La tarifa se ha modificado correctamente.'));
            }
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al modificar la tarifa.");
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Elimina la tarifa del producto indicado
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $producto, Price $price)
    {
        try {
            
            Log::debug($price);
            
            $price->delete();
            
        } catch (\Exception $ex) {
            $error = __('Se ha producido un error al intentar eliminar la tarifa.');
            Log::error($ex);
            Flash::error($error);
            return Redirect::back();
        }
        
        // Redirect to the group management page
        return Redirect::back()->with('success', __('Tarifa eliminada correctamente.'));
    }
}
