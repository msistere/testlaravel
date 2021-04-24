<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Redirect;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Muestra el listado de productos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el formulario de alta de un producto
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = app('rinvex.categories.category')->get()->toFlatTree();
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Alamcena en base de datos, el nuevo producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            DB::beginTransaction();
            
            $validator = \Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
                'image.*' => 'image|max:2024',
                'category_id.*' => 'nullable|exists:categories,id',
            ]);
            
            if (!$validator->fails()) {    
                $product = new Product();
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                
                //Imágenes
                if ($images = $request->file('image')) {
                    foreach ($images as $image) {
                        $product->addMedia($image)->usingName($product->name)
                            ->toMediaCollection('images');
                    }
                }
                
                
                //Categorías
                $categories = collect();
                foreach($request->category_id as $category_id){
                    if (!empty($category_id)){
                        $categories->push($category_id);
                    }
                }
                $product->attachCategories($categories);
                
                DB::commit();
                
                return Redirect::route('productos.index')->with('success', __('El producto se ha guardado correctamente.'));
            }
            DB::rollBack();
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al guardar el producto.");
            DB::rollBack();
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Muestra el detalle de un producto
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $producto)
    {
        return view('admin.products.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $producto)
    {
        $categories = app('rinvex.categories.category')->get()->toFlatTree();
        
        return view('admin.products.edit', compact('producto', 'categories'));
    }

    /**
     * Modifica el producto almacenado en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $producto)
    {
        try {
            
            DB::beginTransaction();
            
            $validator = \Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
                'image.*' => 'image|max:2024',
                'category_id.*' => 'nullable|exists:categories,id',
            ]);
            
            if (!$validator->fails()) {
                $producto->name = $request->name;
                $producto->description = $request->description;
                $producto->save();
                
                //Imágenes
                if ($images = $request->file('image')) {
                    foreach ($images as $image) {
                        $producto->addMedia($image)->usingName($producto->name)
                        ->toMediaCollection('images');
                    }
                }
                
                
                //Categorías
                $categories = collect();
                foreach($request->category_id as $category_id){
                    if (!empty($category_id)){
                        $categories->push($category_id);
                    }
                }
                $producto->syncCategories($categories);
                
                DB::commit();
                
                return Redirect::route('productos.index')->with('success', __('El producto se ha modificado correctamente.'));
            }
            DB::rollBack();
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al modificar el producto.");
            DB::rollBack();
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Elimina el producto
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $producto)
    {
        try {
            
            $producto->delete();
            
        } catch (\Exception $ex) {
            $error = __('Se ha producido un error al intentar eliminar el producto.');
            Log::error($ex);
            Flash::error($error);
            return Redirect::route('productos.index');
        }
        
        // Redirect to the group management page
        return redirect(route('productos.index'))->with('success', __('Producto eliminado correctamente.'));
    }
}
