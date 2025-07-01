<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AnalystController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\AnalistaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\RelatorioController;
use App\Http\Controllers\Cliente\ChamadoController;
use App\Http\Controllers\Cliente\SolicitacaoController;
use App\Http\Controllers\Analista\ChamadosAnalistaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //Rotas Departamentos:
    Route::get('/admin/equipes', [DepartamentoController::class, 'index'])->name('equipes.index');
    Route::get('/admin/equipes/create', [DepartamentoController::class, 'create'])->name('equipes.create');
    Route::post('/admin/equipes', [DepartamentoController::class, 'store'])->name('equipes.store');
    Route::get('/admin/equipes/{id}/show', [DepartamentoController::class, 'show'])->name('equipes.show');
    Route::get('/admin/equipes/{id}/edit', [DepartamentoController::class, 'edit'])->name('equipes.edit');
    Route::put('/admin/equipes/{id}', [DepartamentoController::class, 'update'])->name('equipes.update');
    Route::delete('/admin/equipes/{id}', [DepartamentoController::class, 'destroy'])->name('equipes.destroy');
    
    //Rotas Analistas:
    Route::get('/admin/analistas', [AnalistaController::class, 'index'])->name('analistas.index');
    Route::get('/admin/analistas/create', [AnalistaController::class, 'create'])->name('analistas.create');
    Route::post('/admin/analistas', [AnalistaController::class, 'store'])->name('analistas.store');
    Route::get('/admin/analistas/{id}/show', [AnalistaController::class, 'show'])->name('analistas.show');
    Route::get('/admin/analistas/{id}/edit', [AnalistaController::class, 'edit'])->name('analistas.edit');
    Route::put('/admin/analistas/{id}', [AnalistaController::class, 'update'])->name('analistas.update');
    Route::delete('/admin/analistas/{id}', [AnalistaController::class, 'destroy'])->name('analistas.destroy');

    //Rotas Categorias:
    Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/admin/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/admin/categorias/{id}/show', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/admin/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/admin/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    //Rota Relatorios:
    Route::get('/admin/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/admin/relatorios/chamados', [RelatorioController::class, 'relatorioChamados'])->name('relatorios.chamados');
});

Route::group(['middleware' => ['auth', 'is_analyst']], function () {

    Route::get('/analista/dashboard', [AnalystController::class, 'index'])->name('analista.dashboard');

    Route::get('/analista/chamados', [ChamadosAnalistaController::class, 'index'])->name('analista.chamados.index');
    Route::get('/analista/chamados/equipe', [ChamadosAnalistaController::class, 'equipe'])->name('analista.chamados.equipe');
    Route::get('/analista/chamados/todos', [ChamadosAnalistaController::class, 'todos'])->name('analista.chamados.todos');

    Route::get('/analista/chamados/{id}', [ChamadosAnalistaController::class, 'show'])->name('analista.chamados.show');
    Route::put('/analista/chamados/{id}', [ChamadosAnalistaController::class, 'update'])->name('analista.chamados.update');
    Route::post('/analista/chamados/{id}/comments', [ChamadosAnalistaController::class, 'storeComment'])->name('analista.chamados.comments.store');
    Route::patch('/analista/chamados/{id}/resolve', [ChamadosAnalistaController::class, 'resolve'])->name('analista.chamados.resolve');
    Route::patch('/analista/chamados/{id}/cancel', [ChamadosAnalistaController::class, 'cancel'])->name('analista.chamados.cancel');

});

Route::group(['middleware' => ['auth', 'is_client']], function () {

    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');

    //Chamados
    Route::get('/cliente/chamados', [ChamadoController::class, 'index'])->name('chamados.index');
    Route::get('/cliente/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');
    Route::post('/cliente/chamados', [ChamadoController::class, 'store'])->name('chamados.store');
    Route::get('/cliente/chamados/{id}', [ChamadoController::class, 'show'])->name('chamados.show');
    Route::post('/cliente/chamados/{id}/comments', [ChamadoController::class, 'addComment'])->name('chamados.comments.store');
    Route::patch('/cliente/chamados/{id}/cancel', [ChamadoController::class, 'cancel'])->name('chamados.cancel');

    //Solicitações: 
    Route::get('/cliente/solicitacoes', [SolicitacaoController::class, 'index'])->name('solicitacao.index');
    Route::get('/cliente/solicitacoes/create/{titulo}/{categoryId}/{urgencyId}', [SolicitacaoController::class, 'create'])->name('solicitacao.create');
    Route::post('/cliente/solicitacoes', [SolicitacaoController::class, 'store'])->name('solicitacao.store');
});

// Rota de redirecionamento após login
Route::get('/dashboard', function () {
    switch (auth()->user()->type) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'analyst':
            return redirect()->route('analista.dashboard');
        default:
            return redirect()->route('cliente.dashboard');
    }
})->middleware(['auth'])->name('dashboard');
