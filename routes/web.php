<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrumblerController;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()){
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});
Route::post('/login_new',[LoginController::class,'authenticate'])->name('login-new');
Route::middleware(['auth','role:Player'])->group(function () {
    Route::get('/start',[ScrumblerController::class,'index']);
    Route::post('/start_now',[ScrumblerController::class,'start_now']);
    Route::get('/scrambler',[ScrumblerController::class,'scrambler']);
    Route::get('/scrambler/finish',[ScrumblerController::class,'finish']);
    Route::post('/check_word',[ScrumblerController::class,'check_word'])->name('check_word');
    Route::get('/myprofile',[ProfileController::class,'index']);
    Route::get('/myprofile/stages/detail/{stage}',[ProfileController::class,'detail']);
});
Route::group(['middleware'=>['auth', 'role:Admin']],function(){
    Route::prefix('user')->group(function () {
        Route::get('/',[DashboardController::class,'user'])->name('user');
        Route::get('/detail/{user}',[DashboardController::class,'detail']);
        Route::get('/history_log/{stage}',[DashboardController::class,'history_log']);
        
    });
    Route::get('/words',[DashboardController::class,'words']);
    Route::post('store_words',[DashboardController::class,'store_words'])->name('store.word');
    Route::post('/edit_word',[DashboardController::class,'edit_word'])->name('edit.word');
});
Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth')->name('dashboard');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
