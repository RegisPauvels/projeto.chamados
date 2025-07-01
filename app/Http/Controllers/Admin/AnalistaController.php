<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnalistaController extends Controller
{
  
    public function index()
    {
        $analysts = User::where('type', 'analyst')->orderBy('name')->get();
        return view('admin.analistas.index', compact('analysts'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.analistas.create', compact('departments'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['type'] = 'analyst';

        User::create($validated);

        return redirect()->route('analistas.index')->with('success', 'Analista criado com sucesso!');
    }


    
    public function edit($id)
    {
        $analyst = User::findOrFail($id);
        $departments = Department::all();
        return view('admin.analistas.edit', compact('analyst', 'departments'));
    }

    public function show($id)
    {
        $analyst = User::with(['department'])->findOrFail($id);
        return view('admin.analistas.show', compact('analyst'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'department_id' => 'required|exists:departments,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $analyst = User::findOrFail($id);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $analyst->update($validated);

        return redirect()->route('analistas.index')->with('success', 'Analista atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $analyst = User::findOrFail($id);
        $analyst->delete();

        return redirect()->route('analistas.index')->with('success', 'Analista removido!');
    }
}