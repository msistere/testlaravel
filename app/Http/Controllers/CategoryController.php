<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Redirect;
use Flash;

class CategoryController extends Controller
{
    /**
     * Muestra un listado de categorías
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = app('rinvex.categories.category')->get();
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Muestra el formuario de alta de categoría
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = app('rinvex.categories.category')->get()->toFlatTree();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Guarda en base de datos una nueva categoría
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {            
        
            $validator = \Validator::make($request->all(), [
                'parent_id' => 'nullable|exists:categories,id',
                'name' => 'required'
            ]);
            
            if (!$validator->fails()) {
                app('rinvex.categories.category')->create(['parent_id' => $request->parent_id, 'name' => $request->name, 'description' => $request->description]);
                
                return Redirect::route('categorias.index')->with('success', __('La categoría se ha guardado correctamente.'));
            }
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al guardar la categoría.");
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Muestra los datos de una categoría
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = app('rinvex.categories.category')->find($id);
        
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Muestra el formulario de edición de una categoría
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = app('rinvex.categories.category')->get()->toFlatTree();
        $category = app('rinvex.categories.category')->find($id);
        
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Modifica una categoría en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $validator = \Validator::make($request->all(), [
                'parent_id' => 'nullable|exists:categories,id',
                'name' => 'required'
            ]);
            
            if (!$validator->fails()) {
                $category = app('rinvex.categories.category')->find($id);
                $category->update([
                    'parent_id' =>  $request->parent_id,
                    'name' => $request->name,
                    'description' => $request->description
                ]);
                
                return Redirect::route('categorias.index')->with('success', __('La categoría se ha modificado correctamente.'));
            }
            return Redirect::back()->withErrors($validator)->withInput();
            
        } catch (\Exception $e) {
            Log::error($e);
            $error = __("Se ha producido un error al modificar la categoría.");
        }
        
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Elimina la categoría
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        
        try {
            
            $category = app('rinvex.categories.category')->find($id);
            
            $category->delete();
            
        } catch (\Exception $ex) {
            $error = __('Se ha producido un error al intentar eliminar la categoría.');
            Log::error($ex);
            Flash::error($error);
            return Redirect::route('categorias.index');
        }
        
        // Redirect to the group management page
        return redirect(route('categorias.index'))->with('success', __('Categoría eliminada correctamente.'));
    }
}
