<?php

namespace App\Services;

use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductServices
{
    public function store($data)
    {

        $product = new ProductModel();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->save();

        return response()->json(['message' => 'Success'], 201);
    }
}
