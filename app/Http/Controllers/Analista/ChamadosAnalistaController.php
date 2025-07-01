<?php

namespace App\Http\Controllers\Analista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\UrgencyLevel;
use App\Models\Department;
use App\Models\Category;

class ChamadosAnalistaController extends Controller
{
    public function index(Request $request){

        $query = Ticket::with(['client', 'analyst', 'department', 'urgency'])
                ->where('analyst_id', auth()->id())  
                ->latest();

        if ($request['idChamado']) {
            $query->where('id', $request['idChamado']);
        }

        $tickets = $query->paginate(15);

        return view('analista.chamados.index', compact('tickets'));
    }
    

    public function equipe(Request $request){

        
        $userDepartmentId = auth()->user()->department_id;

     
        $query = Ticket::with(['client', 'analyst', 'department', 'urgency'])
                    ->where('department_id', $userDepartmentId) 
                    ->latest();

        if ($request['idChamado']) {
            $query->where('id', $request['idChamado']);
        }

        $tickets = $query->paginate(15);

        return view('analista.chamados.equipe', compact('tickets'));
    }


    public function todos(Request $request)
    {

        $filters = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'analyst_id' => $request->input('analyst_id'),
            'department_id' => $request->input('department_id'),
            'category_id' => $request->input('category_id'),
            'urgency_level_id' => $request->input('urgency_level_id'),
            'status' => $request->input('status'),
        ];

  
        $query = Ticket::with(['client', 'analyst', 'department', 'category', 'urgency'])
            ->orderBy('created_at', 'desc');


        $this->aplicarFiltros($query, $filters);


        $filterData = [
            'analysts' => User::where('type', 'analyst')->orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'urgencyLevels' => UrgencyLevel::orderBy('name', 'desc')->get(),
            'statuses' => Ticket::STATUSES,
        ];

        return view('analista.chamados.todos', [
            'tickets' => $query->paginate(20)->appends($request->query()),
            'filterData' => $filterData,
            'filters' => $filters,
        ]);
    }


    private function aplicarFiltros($query, $filters)
    {
   
        if ($filters['start_date']) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if ($filters['end_date']) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        if ($filters['analyst_id']) {
            $query->where('analyst_id', $filters['analyst_id']);
        }


        if ($filters['department_id']) {
            $query->where('department_id', $filters['department_id']);
        }

   
        if ($filters['category_id']) {
            $query->where('category_id', $filters['category_id']);
        }


        if ($filters['urgency_level_id']) {
            $query->where('urgency_level_id', $filters['urgency_level_id']);
        }


        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }
    }



    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $departments = Department::orderBy('name')->get();
        $analysts = User::where('type', 'analyst')->orderBy('name')->get();
        $urgencyLevels = UrgencyLevel::orderBy('id', 'desc')->get();

        return view('analista.chamados.show', compact(
            'ticket',
            'departments',
            'analysts',
            'urgencyLevels'
        ));
    }


    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'analyst_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,assigned,in_progress,on_hold,resolved,closed,cancelled',
            'urgency_level_id' => 'required|exists:urgency_levels,id',
        ]);


        $ticket->update($validated);


        if ($request->analyst_id && $ticket->status == 'open') {
            $ticket->update(['status' => 'assigned']);
        }

        return redirect()
            ->route('analista.chamados.show', $ticket)
            ->with('success', 'Chamado atualizado com sucesso!');
    }


    public function storeComment(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'is_private' => 'nullable|boolean',
        ]);


        $ticket->comments()->create([
            'comment' => $validated['comment'],
            'is_private' => $request->has('is_private'),
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('analista.chamados.show', $ticket)
            ->with('success', 'Comentário adicionado com sucesso!');
    }

    public function resolve($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'resolved',
            'closed_at' => now(),
        ]);

        return redirect()
            ->route('analista.chamados.show', $ticket)
            ->with('success', 'Chamado marcado como resolvido!');
    }

    public function cancel($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'cancelled',
            'closed_at' => now(),
        ]);

        return redirect()
            ->route('analista.chamados.show', $ticket)
            ->with('success', 'Chamado cancelado com sucesso!');
    }
}

