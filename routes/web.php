<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrumblerController;
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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});
Route::post('/login_new',[LoginController::class,'authenticate'])->name('login-new');
Route::get('/start',[ScrumblerController::class,'index']);
Route::post('/start_now',[ScrumblerController::class,'start_now']);
Route::get('/scrambler',[ScrumblerController::class,'scrambler']);
Route::get('/scrambler/finish',[ScrumblerController::class,'finish']);
Route::post('/check_word',[ScrumblerController::class,'check_word'])->name('check_word');
Route::get('/myprofile',[ProfileController::class,'index']);
Route::get('/myprofile/stages/detail/{stage}',[ProfileController::class,'detail']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
