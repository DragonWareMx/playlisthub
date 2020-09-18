<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('spotify')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        if($request->error){
            return redirect()->route('login')->withErrors(['msg'=> 'Hubo un error al autentificarse con Spotify. Por favor vuelva a intentarlo.']);
        }

        $userSocialite = Socialite::driver('spotify')->user();
        Session::put('access_token',$userSocialite->token);
        $user=User::where('spotify_id',$userSocialite->getId())->first();
        if($user){
            auth()->login($user);
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')->withErrors(['msg' => 'La cuenta de Spotify con la que intentas ingresar no se encuentra registrada.']);
        }
    }
}
