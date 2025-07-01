<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UrgencyLevel;

class NivelUrgenciaController extends Controller
{
    public function index()
    {
        $urgencias = UrgencyLevel::select('id', 'name')->orderBy('name')->get();

        return response()->json($urgencias);
    }
}
