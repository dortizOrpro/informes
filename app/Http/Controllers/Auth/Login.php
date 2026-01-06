<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

//        $arrUser = [
//            'id' => 85051300,
//            'name' => 'Orpro S.A.',
//            'nickname' => 'orpro',
//            'rol' => 4,
//            'perfil' => 'Basico 1',
//        ];
//        Auth::login(new GenericUser($arrUser));

        return Socialite::driver('keycloak')->redirect();
    }
}
