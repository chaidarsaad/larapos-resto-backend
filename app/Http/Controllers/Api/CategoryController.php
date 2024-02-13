<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all(Request $request)
    {
        $category = Category::all();
        return response()->json([
            'messages' => 'berhasil mendapatkan data categories',
            'success' => true,
            'data' => [
                'categories' => $category
            ],
        ], 200);
    }
}
