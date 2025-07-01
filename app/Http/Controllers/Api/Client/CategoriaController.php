<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriaController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();

        return response()->json($categories);
    }

    public function show($id)
    {
        $categoria = Category::findOrFail($id);
        return response()->json($categoria);
    }
}
