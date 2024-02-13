<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $product = Product::with('category')->get();
        return response()->json([
            'messages' => 'berhasil mendapatkan data products',
            'success' => true,
            'data' => [
                'product' => $product
            ],
        ], 200);
    }
}
