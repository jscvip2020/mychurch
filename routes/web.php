<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\PastoralController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RedeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontEnd\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes();
Route::prefix('admin')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('usuarios', UserController::class, ['except' => ['show','create','store']]);
    Route::get('usuarios/{status}/{id}',[UserController::class,'status'])->name('usuarios.status');

    Route::resource('pastorais', PastoralController::class, ['except' => ['show']]);
    Route::get('pastorais/{status}/{id}',[PastoralController::class,'status'])->name('pastorais.status');

    Route::resource('redes', RedeController::class, ['except' => ['show']]);
    Route::get('redes/{status}/{id}',[RedeController::class,'status'])->name('redes.status');

    Route::resource('noticias', NoticiaController::class);
    Route::get('noticias/{status}/{id}',[NoticiaController::class,'status'])->name('noticias.status');
    Route::get('noticias/{small}/{id}/destaque',[NoticiaController::class,'pequena'])->name('noticias.destaque');
    Route::get('noticias/{big}/{id}/principal',[NoticiaController::class,'grande'])->name('noticias.principal');

});

