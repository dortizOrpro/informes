<?php

use App\Http\Controllers\Auth\Callback;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LogOut;
use Illuminate\Support\Facades\Route;
use Src\Procesos\Infraestructure\Controllers\ActividadesMasivasController;
use Src\Informes\Infraestructure\Controllers\CronologiaController;
use Src\Informes\Infraestructure\Controllers\FichasController;
use Src\Informes\Infraestructure\Controllers\InformeController;

$routeMiddleware = App::environment() === 'production' ?['auth'] : [];
//dd(App::environment());
Route::middleware($routeMiddleware)->group(function () {
    Route::get('/informes', InformeController::class)->name('informes');
    Route::get('/cronologias', CronologiaController::class)->name('informes.cronologias');
    Route::get('/equivalencias', InformeController::class)->name('informes.equivalencias');
    Route::get('/fichas', FichasController::class)->name('informes.fichas');
    Route::get('/actividades-masivas', ActividadesMasivasController::class)->name('actividades.masivas');
});

Route::get('/login', Login::class)
    ->name('login');

Route::get('/auth/callback', Callback::class)
    ->name('auth.callback');

Route::get('/logout', LogOut::class)
    ->name('logout');

Route::get('/salir', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/debug20250929', function () {
    dd(Auth::user());
});
