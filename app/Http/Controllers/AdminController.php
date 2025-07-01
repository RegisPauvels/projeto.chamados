<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {   

   
    $startDate = Carbon::now()->subMonths(4)->startOfMonth();
    $endDate = Carbon::now()->endOfMonth();

    
    $ticketsPerMonth = Ticket::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    
    $labels = [];
    $data = [];

 
    $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);

    foreach ($period as $date) {
        $monthKey = $date->format('Y-m');
        $label = $date->format('M/Y'); 

        $labels[] = $label;
        $match = $ticketsPerMonth->firstWhere('month', $monthKey);
        $data[] = $match ? $match->total : 0;
    }

    $chamadosAbertos = Ticket::whereIn('status', ['open', 'assigned', 'in_progress', 'on_hold'])->count();

    $chamadosEncerrados = Ticket::whereIn('status', ['resolved', 'closed', 'cancelled'])->count();

    $todosChamados = Ticket::all()->count();


    return view('admin.dashboard', [
        'ticketLabels' => $labels,
        'ticketData' => $data,
        'chamadosAbertos' => $chamadosAbertos,
        'chamadosEncerrados' => $chamadosEncerrados,
        'todosChamados' => $todosChamados,
    ]);
       
    }
}
