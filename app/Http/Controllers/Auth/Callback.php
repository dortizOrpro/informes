<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class Callback extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $logged = Socialite::driver('keycloak')->user();
        $user = User::updateOrCreate([
            'email' => $logged->email,
        ], [
            'name' => $logged->name,
            'perfil' => Arr::get($logged->user, 'resource_access.recaudacion.roles.0'),
        ]);
        Auth::login($user);
        return redirect('/');
    }
}
