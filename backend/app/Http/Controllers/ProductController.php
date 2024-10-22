<?php

namespace App\Http\Controllers;

use App\Services\ProductServices;
use Illuminate\Http\Request;

class ProductController
{
    protected $productServices;

    public function __construct(ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }

    public function store(Request $request)
    {
        return $this->productServices->store($request);
    }
}
