<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categorias.index', compact('categories'));
    }

    public function create()
    {   
        $departments = Department::all();
        return view('admin.categorias.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'department_id' => 'required|exists:departments,id',
        ]);

        Category::create($validated);

        return  redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categorias.show', compact('category'));

    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $departments = Department::all();
        return view('admin.categorias.edit', compact('category', 'departments'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'department_id' => 'required|exists:departments,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return  redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

 
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return  redirect()->route('categorias.index')->with('success', 'Categoria removida com sucesso!');
    }
}
