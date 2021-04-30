<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\ApiResponser;

class ProductController extends Controller
{
    use ApiResponser;
    
    /**
     * Muestra el listado de productos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $products = Product::with(['categories', 'media'])
            ->with(['prices' => function ($query) {
                $query->where('from', '<=', date('Y-m-d', strtotime(today())));
                $query->where('to', '>=', date('Y-m-d', strtotime(today())));
            }])
            ->orderBy('name', 'asc')->get();
        
        return $this->success([
            'products' => $products
        ]);
    }
}
