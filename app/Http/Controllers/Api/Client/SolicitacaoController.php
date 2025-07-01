<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UrgencyLevel;
use App\Models\Ticket;

class SolicitacaoController extends Controller
{
   
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $urgencyLevels = UrgencyLevel::all();

        return response()->json([
            'categories' => $categories,
            'urgency_levels' => $urgencyLevels,
        ]);
    }

    public function create($titulo, $categoryId, $urgencyId)
    {
        $category = Category::findOrFail($categoryId);
        $urgency_level = UrgencyLevel::findOrFail($urgencyId);

        $map = [
            'periferico'    => "Solicitação de periféricos",
            'movimentacao'  => "Movimentação de equipamentos de TI",
            'desktop'       => "Solicitação de Desktop/Notebook",
            'rede'          => "Solicitação de ponto de rede",
            'software'      => "Solicitação / Aquisição de Software",
            'telefonia'     => "Solicitação de ramal",
        ];

        $tituloCompleto = $map[$titulo] ?? $titulo;

        return response()->json([
            'title' => $tituloCompleto,
            'category' => $category,
            'urgency_level' => $urgency_level
        ]);
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'urgency_level_id' => 'required|exists:urgency_levels,id',
            'description' => 'required|string|min:10',
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $ticket = Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'open',
            'client_id' => $request->user()->id,
            'category_id' => $validated['category_id'],
            'urgency_level_id' => $validated['urgency_level_id'],
            'ticket_type_id' => 2,
            'department_id' => $category->department_id,
        ]);

        return response()->json([
            'message' => 'Solicitação enviada com sucesso!',
            'ticket' => $ticket
        ], 201);
    }
}
