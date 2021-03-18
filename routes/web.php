<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
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



Auth::routes();



Route::get('/', [UserController::class, 'index']);
Route::get('/user_todos/{id}', [TodoController::class, 'index'] )->name('listaTodos');
Route::get('/get_todo/{id}', [TodoController::class, 'get'] )->name('get_todo');
Route::post('/save_todo', [TodoController::class, 'store'] )->name('save_todo');
Route::post('/update_todo', [TodoController::class, 'update'] )->name('update_todo');
Route::post('/delete_todo', [TodoController::class, 'destroy'] )->name('delete_todo');




