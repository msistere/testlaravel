<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
    use ApiResponser;
    
    /**
     * Muestra el listado de categorías
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = app('rinvex.categories.category')->get()->toFlatTree();
        
        return $this->success([
            'categories' => $categories
        ]);
    }
}
