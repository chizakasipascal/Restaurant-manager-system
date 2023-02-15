<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\AuthorizationConttroller;

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
    return view('welcome');
});


Auth::routes(
//    ["register" => false, "reset" => false]
);


// Route::get('/admin', [AuthorizationConttroller::class, 'index'])->name('gate.index');


Route::prefix('admin')->middleware('isAdmin')->group(function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('tables', TableController::class);
    Route::resource('servants', ServantController::class);
    Route::resource('menus', MenuController::class);

    Route::get('reports', [ReportController::class,'index'])->name("reports.index");
    Route::post('show/reports', [ReportController::class,'show'])->name("reports.show");
    Route::post('export/reports', [ReportController::class,'generate'])->name("reports.generate");
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeAdminController::class, 'index'])->name('admin');

Route::resource('sales', SalesController::class);
