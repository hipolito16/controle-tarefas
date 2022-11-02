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

Route::get('/', [\App\Http\Controllers\TarefaController::class, 'index']);

//Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//    ->name('home')
//    ->middleware('verified');

Route::resource('tarefa', App\Http\Controllers\TarefaController::class)
    ->middleware('verified');
