<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class AnalystController extends Controller
{
     public function index()
    {   

    $analystId = auth()->id(); 

    $chamadosAbertos = Ticket::where('analyst_id', $analystId)
        ->whereIn('status', ['open', 'assigned', 'in_progress', 'on_hold'])
        ->count();

    $chamadosEncerrados = Ticket::where('analyst_id', $analystId)
        ->whereIn('status', ['resolved', 'closed', 'cancelled'])
        ->count();

    $todosChamados = Ticket::where('analyst_id', $analystId)->count();


    return view('analista.dashboard', [
        'chamadosAbertos' => $chamadosAbertos,
        'chamadosEncerrados' => $chamadosEncerrados,
        'todosChamados' => $todosChamados,
    ]);
       
    }
}
