<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Client\ChamadoController;
use App\Http\Controllers\Api\Client\SolicitacaoController;
use App\Http\Controllers\Api\Client\NivelUrgenciaController;
use App\Http\Controllers\Api\Client\CategoriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    //Categorias
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);

    //Urgencias 
Route::get('/urgencias', [NivelUrgenciaController::class, 'index']);  


Route::post('/login', [AuthController::class, 'login']); 
Route::middleware(['auth:sanctum', 'is_client'])->group(function () {
    
    Route::get('/user', fn () => auth()->user()); 
    Route::post('/logout', [AuthController::class, 'logout']); 

    // Chamados do cliente (equivalente a ChamadoController)
    Route::get('/chamados', [ChamadoController::class, 'index']);
    Route::post('/chamados', [ChamadoController::class, 'store']);
    Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
    Route::patch('/chamados/{id}/cancel', [ChamadoController::class, 'cancel']);
    Route::post('/chamados/{id}/comments', [ChamadoController::class, 'addComment']);

    // Solicitações (equivalente a SolicitacaoController)
    Route::get('/solicitacoes', [SolicitacaoController::class, 'index']);
    Route::post('/solicitacoes', [SolicitacaoController::class, 'store']);
    Route::get('/solicitacoes/create/{titulo}/{categoryId}/{urgencyId}', [SolicitacaoController::class, 'create']); 
});
