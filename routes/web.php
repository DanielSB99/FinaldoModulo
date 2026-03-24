<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\JogoController;
use Illuminate\Support\Facades\Route;

// ─── Rotas Públicas ───────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home');
});

Route::get('/estudios', [EstudioController::class, 'index'])->name('Todos_estudios');
Route::get('/estudios/{id}/jogos', [EstudioController::class, 'jogosDoEstudio'])->name('JogosEstudio');
Route::get('/jogos', [JogoController::class, 'index'])->name('Todos_jogos');

// ─── Rotas para utilizadores autenticados ────────────────────────────────────

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('Dashboard')
    ->middleware(['auth']);

Route::get('/jogos/{id}/edit', [JogoController::class, 'edit'])
    ->middleware(['auth'])
    ->name('jogos.edit');

Route::put('/jogos/{id}', [JogoController::class, 'update'])
    ->middleware(['auth'])
    ->name('jogos.update');

// ─── Rotas exclusivas de Administrador ───────────────────────────────────────

Route::get('/estudios/create', [EstudioController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('estudios.create');

Route::post('/estudios', [EstudioController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('estudios.store');

Route::get('/estudios/{id}/edit', [EstudioController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('estudios.edit');

Route::put('/estudios/{id}', [EstudioController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('estudios.update');

Route::delete('/estudios/{id}', [EstudioController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('estudios.destroy');

Route::get('/jogos/create', [JogoController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('jogos.create');

Route::post('/jogos', [JogoController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('jogos.store');

Route::delete('/jogos/{id}', [JogoController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('jogos.destroy');


Route::fallback(function () {
    return view('fallback');
});
