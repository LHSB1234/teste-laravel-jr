<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\MercadoLivreController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rotas de produtos
Route::get('/produtos/cadastrar', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produtos/index', [ProdutoController::class, 'index'])->name('produtos.index');

// Rotas do Mercado Livre
Route::get('/mercado-livre/authorize', [MercadoLivreController::class, 'authorize'])->name('mercado-livre.authorize');
Route::get('/mercado-livre/callback', [MercadoLivreController::class, 'callback'])->name('mercado-livre.callback');
Route::get('/mercado-livre/test-api', [MercadoLivreController::class, 'testApi'])->name('mercado-livre.test-api');
