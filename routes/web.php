<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SenjataController;
use App\Http\Controllers\SubjenisController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\JoinController;


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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/senjatas/trash', [SenjataController::class, 'deletelist']);
    Route::get('/senjatas/trash/{senjata}/restore', [SenjataController::class, 'restore']);
    Route::get('/senjatas/trash/{senjata}/forcedelete', [SenjataController::class, 'deleteforce']);
    Route::resource('senjatas', SenjataController::class);
    Route::get('/subtypes/trash', [SubjenisController::class, 'deletelist']);
    Route::get('/subtypes/trash/{subtype}/restore', [SubjenisController::class, 'restore']);
    Route::get('/subtypes/trash/{subtype}/forcedelete', [SubjenisController::class, 'deleteforce']);
    Route::resource('subtypes', SubjenisController::class);
    Route::get('/types/trash', [TypeController::class, 'deletelist']);
    Route::get('/types/trash/{subtype}/restore', [TypeController::class, 'restore']);
    Route::get('/types/trash/{subtype}/forcedelete', [TypeController::class, 'deleteforce']);
    Route::resource('types', TypeController::class);
    Route::get('/totals', [JoinController::class,'index']);
});