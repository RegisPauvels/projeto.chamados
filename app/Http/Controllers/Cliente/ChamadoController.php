<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UrgencyLevel;
use App\Models\Ticket;
use App\Models\TicketComment;

class ChamadoController extends Controller
{
    public function index()
    {
        
        $tickets = Ticket::where('client_id', auth()->id())
                        ->with('department')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('client.chamados.index', compact('tickets'));
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $urgencyLevels = UrgencyLevel::all();

        return view('client.chamados.create', compact('categories', 'urgencyLevels'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'urgency_level_id' => 'required|exists:urgency_levels,id',
            'description' => 'required|string|min:10',
        ]);

        $validateData['ticket_type_id'] = '1';

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
            ->with('success', 'Chamado criado com sucesso! Número: #'.$ticket->id);


    }

    public function show($id){

        $ticket = Ticket::findOrFail($id);

        return view('client.chamados.show', compact('ticket'));
    }

    public function addComment(Request $request, $id)
    {   
        $ticket = Ticket::findOrFail($id);
        
    
        $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'is_private' => 'sometimes|boolean'
        ]);

        
        $comment = new TicketComment([
            'comment' => $request->content,
            'is_private' => $request->is_private ?? false,
            'user_id' => auth()->id()
        ]);

        $ticket->comments()->save($comment);

        return back()->with('success', 'Comentário adicionado com sucesso!');
    }

   
    public function cancel(Request $request, $id)
    {   
        $ticket = Ticket::findOrFail($id);

        
        if (auth()->id() !== $ticket->client_id) {
            abort(403, 'Apenas o solicitante pode cancelar este chamado');
        }

       
        if (!$ticket->isOpen()) {
            return back()->with('error', 'Este chamado não pode ser cancelado no estado atual');
        }

        
        $ticket->update([
            'status' => 'cancelled',
            'closed_at' => now()
        ]);

        return redirect()->route('chamados.show', $ticket)
                         ->with('success', 'Chamado cancelado com sucesso');
    }
    
}
