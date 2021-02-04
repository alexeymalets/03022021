<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/parser', [\App\Http\Controllers\ParserController::class, 'index'])->name('parser');

Route::get('/', [\App\Http\Controllers\ArticleController::class, 'index']);

Route::get('/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');

