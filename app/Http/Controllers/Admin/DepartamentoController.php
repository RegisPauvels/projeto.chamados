<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.equipes.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.equipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Department::create($request->all());

        return redirect()->route('equipes.index')->with('success', 'Equipe criada com sucesso!');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.equipes.edit', compact('department'));
    }

    public function show($id)
    {
        $department = Department::with(['analysts' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->findOrFail($id);;
        return view('admin.equipes.show', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());

        return redirect()->route('equipes.index')->with('success', 'Equipe atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('equipes.index')->with('success', 'Equipe removida!');
    }
}
