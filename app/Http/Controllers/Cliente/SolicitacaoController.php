<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UrgencyLevel;
use App\Models\Ticket;

class SolicitacaoController extends Controller
{
    public function index(){
        return view('client.solicitacao.index');
    }

    public function create($titulo, $categoryId, $urgencyId)
    {
        $category = Category::findOrFail($categoryId);
        $urgency_level = UrgencyLevel::findOrFail($urgencyId);

        if($titulo == 'periferico'){
            $titulo = "Solicitação de periféricos";
        }elseif($titulo == 'movimentacao'){
            $titulo = "Movimentação de equipamentos de TI";
        }elseif($titulo == 'desktop'){
            $titulo = "Solicitação de Desktop/Notebook";
        }elseif($titulo == 'rede'){
            $titulo = "Solicitação de ponto de rede";
        }elseif($titulo == 'software'){
            $titulo = "Solicitação / Aquisição de Software";
        }elseif($titulo == 'telefonia'){
            $titulo = "Solicitação de ramal";
        }

        return view('client.solicitacao.create', compact('titulo', 'category', 'urgency_level'));
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'urgency_level_id' => 'required|exists:urgency_levels,id',
            'description' => 'required|string|min:10',
        ]);

        $validateData['ticket_type_id'] = '2';

        $category = Category::findOrFail($validatedData['category_id']);

        $ticket = Ticket::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => 'open',
            'client_id' => auth()->id(), 
            'category_id' => $validatedData['category_id'],
            'urgency_level_id' => $validatedData['urgency_level_id'],
            'ticket_type_id' => $validateData['ticket_type_id'],
            'department_id' => $category->department_id,
        ]);

        return redirect()
            ->route('cliente.dashboard', $ticket)
            ->with('success', 'Solicitacao enviada com sucesso! Número: #'.$ticket->id);
    }
}
