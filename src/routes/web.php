<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;

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

// もくもく会一覧画面
Route::get('/', [EventController::class, 'index'])
    ->name('event.index');

// もくもく会登録画面
Route::get('/event/register', [EventController::class, 'register'])
    ->name('event.register');

// もくもく会登録処理
Route::post('/event/create', [EventController::class, 'create'])
    ->name('event.create');

// もくもく会詳細画面
Route::get('/event/{id}', [EventController::class, 'show'])
    ->name('event.show');

// もくもく会編集画面
Route::get('/event/edit/{id}', [EventController::class, 'edit'])
    ->name('event.edit');

// カテゴリー一覧画面
Route::get('/category/index', [CategoryController::class, 'index'])
    ->name('category.index');
