<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ClienteController extends Controller
{
    public function index()
    {
        
        $tickets = Ticket::where('client_id', auth()->id())
                        ->with('department')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        return view('client.dashboard', compact('tickets'));
    }
}
