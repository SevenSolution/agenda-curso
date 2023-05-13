<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EventController::class, 'index'])->middleware('auth')->name('index');


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login.index');
    Route::post('auth', 'auth')->name('login.auth');
    Route::get('logout', 'logout')->name('login.logout');
});

/**
 * Route::resource -> with middleware 'auth'
 */
Route::controller(EventController::class)->middleware('auth')->group(function () {
    Route::get('events', 'index')->name('events.index');
    Route::get('events/create', 'create')->name('events.create');
    Route::post('events', 'store')->name('events.store');
    Route::get('events/{event}', 'show')->name('events.show');
    
/**
 *  rotas de edição e exclusão com middleware para evitar 
 * que o usuário altere/exclua registro que não pertence a ele
 */
    Route::get('events/{event}/edit', 'edit')->middleware('userownerevents')->name('events.edit');
    Route::put('events/{event}', 'update')->middleware('userownerevents')->name('events.update');
    Route::delete('events/{event}', 'destroy')->middleware('userownerevents')->name('events.destroy');
});
