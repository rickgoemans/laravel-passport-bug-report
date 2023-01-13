<?php

use App\Http\Controllers\AuthController;
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

// region AUTH
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'loginForm'])
            ->name('login-form');
        Route::post('login', [AuthController::class, 'loginProcess'])
            ->name('login-process');
    });
// endregion

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:web_new')
    ->group(function () {
        if (!app()->isProduction()) {
            Route::get('test', function () {
                return view('test');
            })
                ->name('view');
        }

        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::get('logout', [AuthController::class, 'logout'])
                    ->name('logout');
            });
    });
