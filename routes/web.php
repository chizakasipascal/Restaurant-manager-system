<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;

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


Auth::routes(["register" => false, "reset" => false]);

// Route::get('/home', 'HomeController@index')->name('home');

//
Route::resource('categories', CategoryController::class);
Route::resource('tables', TableController::class);
Route::resource('servants', ServantController::class);
Route::resource('menus', MenuController::class);

Route::resource('sales', SalesController::class);
// Route::get('payments', [PaymentController::class ,'index'])->name("payments.index");

 

Route::get('reports', [ReportController::class,'index'])->name("reports.index");
Route::post('show/reports', [ReportController::class,'show'])->name("reports.show");
// Route::post('generate/reports', [ReportController::class,'export'])->name("reports.export");
Route::post('export/reports', [ReportController::class,'generate'])->name("reports.generate");
 
//
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
