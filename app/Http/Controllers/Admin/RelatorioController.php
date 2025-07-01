<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Department;
use App\Models\Category;
use App\Models\UrgencyLevel;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('admin.relatorios.index', [
            'topAnalistas' => $this->getTopAnalistas(),
            'topEquipes' => $this->getTopEquipes(),
            'topCategorias' => $this->getTopCategorias(),
            'chamadosPorUrgencia' => $this->getChamadosPorUrgencia(),
        ]);
    }


    private function getTopAnalistas()
    {
        return User::where('type', 'analyst')
                ->withCount(['assignedTickets as resolved_tickets' => function($query) {
                    $query->whereIn('status', ['resolved', 'closed']);
                }])
                ->orderByDesc('resolved_tickets')
                ->take(5)
                ->get();
    }


    private function getTopEquipes()
    {
        return Department::withCount('tickets')
            ->orderByDesc('tickets_count')
            ->take(5)
            ->get();
    }

    private function getTopCategorias()
    {
        return Category::withCount('tickets')
            ->orderByDesc('tickets_count')
            ->take(5)
            ->get();
    }

    private function getChamadosPorUrgencia()
    {
        return Ticket::selectRaw('
                CASE 
                    WHEN urgency_level_id = 1 THEN "Alta"
                    WHEN urgency_level_id = 2 THEN "Baixa"
                    WHEN urgency_level_id = 3 THEN "Média"
                    ELSE "Não definida"
                END as urgency_name,
                COUNT(*) as total
            ')
            ->groupBy('urgency_name')
            ->orderByRaw('
                CASE 
                    WHEN urgency_level_id = 1 THEN 1
                    WHEN urgency_level_id = 2 THEN 2
                    WHEN urgency_level_id = 3 THEN 3
                    ELSE 4
                END
            ')
            ->get();
    }

    public function relatorioChamados(Request $request)
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

        return view('admin.relatorios.relatorioChamados', [
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

}
