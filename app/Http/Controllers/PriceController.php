<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Flash;
use Redirect;
use Illuminate\Support\Facades\Log;

class PriceController extends Controller
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
        //
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
    public function edit(Price $tarifa)
    {
        return view('admin.products.prices.edit', compact('tarifa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Elimina la tarifa del producto indicado
     *
     * @param  $id identificador de la tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $price = Price::find($id);             
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
