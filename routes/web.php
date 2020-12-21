<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Auth::routes();


Route::get('/users/{user}/changePassword',[App\Http\Controllers\UserController::class, 'changePassword'])->name('users.changePassword');
Route::post('/users/{user}/updatePassword',[App\Http\Controllers\UserController::class, 'updatePassword'])->name('users.updatePassword');

Route::resource('users', UserController::class)->only([
    'edit', 'update', 'show'
]);

Route::resource('posts', PostController::class);