<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('produtos/inserir', [ProdutosController::class, 'create'])->name('produtos.inserir');

Route::get('produtos/{id}', [ProdutosController::class, 'show'])->name('produtos.descricao');

//Route::get('produtos/{nome}/{valor?}', [ProdutosController::class, 'show'])->name('produtos.descricao');

Route::get('produtos', [ProdutosController::class, 'index'])->name('produtos');

Route::post('produtos', [ProdutosController::class, 'insert'])->name('produtos.insert');

Route::get('produtos/{produto}/edit', [ProdutosController::class, 'edit'])->name('produtos.edit');

Route::put('produtos/{produto}', [ProdutosController::class, 'editar'])->name('produtos.editar');

Route::get('produtos/{produto}/delete', [ProdutosController::class, 'modal'])->name('produtos.modal');

Route::delete('produtos/{produto}', [ProdutosController::class, 'delete'])->name('produtos.delete');

Route::post('painel', [UsuariosController::class, 'login'])->name('usuarios.login');

Route::get('/', [UsuariosController::class, 'logout'])->name('usuarios.logout');

# Rotas Clientes #

Route::get('clientes', [ClientesController::class, 'index'])->name('clientes');

Route::get('clientes/inserir', [ClientesController::class, 'create'])->name('clientes.inserir');

Route::post('clientes', [ClientesController::class, 'insert'])->name('clientes.insert');

Route::get('clientes/{id}', [ClientesController::class, 'show'])->name('clientes.descricao');

Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');

Route::put('clientes/{cliente}', [ClientesController::class, 'editar'])->name('clientes.editar');

Route::delete('clientes/{cliente}', [ClientesController::class, 'delete'])->name('clientes.delete');

# Ajax -- Clientes #
   Route::post('cli', [ClientesController::class, 'loadimg'])->name('cli.imagem');
#------------------#

