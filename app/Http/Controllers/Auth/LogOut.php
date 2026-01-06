<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LogOut extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $logout = Socialite::driver('keycloak')->getLogoutUrl(
            Config('services.keycloak.app_logout'),//'https://sgc-consignaciones.orpro.cl/salir',
            Config('services.keycloak.client_id')
        );

        return redirect($logout);
    }
}
