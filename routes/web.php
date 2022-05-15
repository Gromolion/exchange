<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainController;
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

Auth::routes();
Route::group([
    'middleware' => 'auth'
], function() {
  Route::get('logout', [LoginController::class, 'logout']);
  Route::get('profile', [MainController::class, 'profile'])->name('profile');

  Route::group([
      'prefix' => 'applications',
      'middleware' => 'expirate'
  ], function () {
      Route::get('sells', [MainController::class, 'sells'])->name('sells');
      Route::get('buys', [MainController::class, 'buys'])->name('buys');
      Route::get('add-sell', [MainController::class, 'addApplicationSell'])->name('add-appl-sell');
      Route::get('add-buy', [MainController::class, 'addApplicationBuy'])->name('add-appl-buy');
      Route::post('confirm', [MainController::class, 'confirmApplication'])->name('confirm-appl');
  });

  Route::get('obligations', [MainController::class, 'obligations'])->name('obligations');
  Route::post('deal', [MainController::class, 'deal'])->name('deal');
  Route::post('resell', [MainController::class, 'resell'])->name('resell');

  Route::group([
      'middleware' => 'admin',
      'prefix' => 'admin'
  ], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('expirate', [AdminController::class, 'expirate'])->name('admin.expirate');
        Route::get('reset', [ResetController::class, 'reset'])->name('admin.reset');

  });
});

Route::get('/', [MainController::class, 'index'] )->name('index');
