<?php

use App\Http\Controllers\Surat;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\Http\Controllers\Surat::class, 'index']);
Route::get('/surat/{param}/{search}', [App\Http\Controllers\Surat::class,'cari'])->name('surat');
Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
Route::post('search', 'App\Http\Controllers\surat@searchDate')->name('main');

// Route::get('/search', [Surat::class, 'search'])->name('search');
//Route::get('/search', [App\Http\Controllers\Surat::class,'search'])->name('search');
