<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PostsController;

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

// Route::middleware(['auth'])->group(
// function () {

//     Route::get('/', function () {
//         return view('/auth/login'); //変更：welcome→top
//     });

//     Auth::routes();

//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//     Route::get('/index', [PostsController::class, 'index']);

//     Route::get('/create-form', [PostsController::class, 'createForm']);
//     Route::post('/create-form', [PostsController::class, 'create']);

//     Route::post('/post/create', [PostsController::class, 'create']);

//     Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);

//     Route::post('post/update', [PostsController::class, 'update']);

//     Route::get('post/{id}/delete', [PostsController::class, 'delete']);
// };


Route::get('/', function () {
    return view('/auth/login'); //変更：welcome→top
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/index', [PostsController::class, 'index']);
    Route::get('/create-form', [PostsController::class, 'createForm']);
    Route::post('/create-form', [PostsController::class, 'create']);
    Route::post('/post/create', [PostsController::class, 'create']);
    Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);
    Route::post('post/update', [PostsController::class, 'update']);
    Route::get('post/{id}/delete', [PostsController::class, 'delete']);

    Route::get('/index', [PostsController::class, 'index'])->name('index');
    Route::get('/search', [PostsController::class, 'search'])->name('search');
});
