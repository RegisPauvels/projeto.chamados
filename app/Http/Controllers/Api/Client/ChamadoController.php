<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UrgencyLevel;
use App\Models\Ticket;
use App\Models\TicketComment;

class ChamadoController extends Controller
{
    
    public function index(Request $request)
    {
        $tickets = Ticket::where('client_id', $request->user()->id)
            ->with(['department', 'category', 'urgency'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tickets);
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
            'ticket_type_id' => 1, 
            'department_id' => $category->department_id,
        ]);

        return response()->json([
            'message' => 'Chamado criado com sucesso!',
            'ticket' => $ticket,
        ], 201);
    }

    
    public function show(Request $request, $id)
    {
        $ticket = Ticket::with(['department', 'category', 'urgency', 'comments.user'])
            ->where('id', $id)
            ->where('client_id', $request->user()->id)
            ->firstOrFail();

        return response()->json($ticket);
    }

 
    public function cancel(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('client_id', $request->user()->id)
            ->firstOrFail();

        if (!$ticket->isOpen()) {
            return response()->json([
                'message' => 'Este chamado não pode ser cancelado no estado atual.'
            ], 400);
        }

        $ticket->update([
            'status' => 'cancelled',
            'closed_at' => now()
        ]);

        return response()->json([
            'message' => 'Chamado cancelado com sucesso!',
            'ticket' => $ticket,
        ]);
    }

    public function addComment(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('client_id', $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'is_private' => 'sometimes|boolean',
        ]);

        $comment = new TicketComment([
            'comment' => $validated['content'],
            'is_private' => $validated['is_private'] ?? false,
            'user_id' => $request->user()->id,
        ]);

        $ticket->comments()->save($comment);

        return response()->json([
            'message' => 'Comentário adicionado com sucesso!',
            'comment' => $comment,
        ], 201);
    }
}
