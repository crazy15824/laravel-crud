<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SwipeController;
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


//Route::get('/', function () {return redirect('/login');});
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::resource('/dashboard/templates', TemplateController::class);
Route::resource('/dashboard/userlists', UserlistController::class);


Route::get('/registration', [AuthController::class, 'registration'])->name('register-user');

Route::resource('/dashboard/swipe', SwipeController::class);


Route::post('/custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 

Route::post('/custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');
