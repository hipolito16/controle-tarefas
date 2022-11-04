<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;

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

Auth::routes(['verify' => true]);

Route::get('/tarefa/exportacao/{extensao}', [App\Http\Controllers\TarefaController::class, 'exportacao'])->name('tarefa.exportacao');
Route::get('/tarefa/exportacao2', [App\Http\Controllers\TarefaController::class, 'exportacao2'])->name('tarefa.exportacao2');
Route::get('/', [\App\Http\Controllers\TarefaController::class, 'index']);

Route::resource('tarefa', App\Http\Controllers\TarefaController::class);
