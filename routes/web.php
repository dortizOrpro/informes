<?php

use App\Http\Controllers\Auth\Callback;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LogOut;
use Illuminate\Support\Facades\Route;
use Src\Caja\Infrastructure\Controllers\CajaController;
use Src\Caja\Infrastructure\Controllers\CalculadoraController;
use Src\Caja\Infrastructure\Controllers\ComprobanteController;
use Src\Caja\Infrastructure\Controllers\PagoController;
use Src\Caja\Infrastructure\Controllers\PagosController;
use Src\Rendicion\Infrastructure\Controllers\RendicionController;

$routeMiddleware = App::environment() === 'production' ?['auth'] : [];
//dd(App::environment());
Route::middleware($routeMiddleware)->group(function () {
    Route::get('/calculadora', CalculadoraController::class)->name('recaudacion.calculadora');
    Route::get('/informes', CajaController::class)->name('recaudacion');
    Route::get('/caja', CajaController::class)->name('recaudacion.caja');
    Route::get('/pago/{id}', PagoController::class)->name('recaudacion.pago');
    Route::get('/pagos', PagosController::class)->name('recaudacion.pagos');
    Route::get('/rendiciones', RendicionController::class)->name('recaudacion.rendicion');
    Route::get('/comprobante/pdf/{id}', ComprobanteController::class)->name('comprobante.pdf')->name('recaudacion.comprobante');
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
