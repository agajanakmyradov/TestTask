<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;

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

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('dashboard');

Route::controller(EmployeeController::class)->middleware('auth')->prefix('employees')->group(function () {
    Route::get('/create', 'create')->name('employees.create');

    Route::get('/', 'index')->name('employees.index');

    Route::post('/', 'store')->name('employees.store');

    Route::get('/delete/{employee}', 'delete')->name('employees.delete');

    Route::get('/edit/{employee}', 'edit')->name('employees.edit');

    Route::post('/update/{employee}', 'update')->name('employees.update');
});


Route::controller(PositionController::class)->middleware('auth')->prefix('positions')->group(function () {
    Route::get('/', 'index')->name('positions.index');

    Route::get('/create', 'create')->name('positions.create');

    Route::post('/store', 'store')->name('positions.store');

    Route::get('/edit/{position}', 'edit')->name('positions.edit');

    Route::post('/update/{position}', 'update')->name('positions.update');

    Route::get('/delete/{position}', 'delete')->name('positions.delete');

});


