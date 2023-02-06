<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

         // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/posts';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void*/

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function login(Request $request, $provider)
    {
        if (!in_array($provider, ['github', 'google'])) {
            return redirect()->to('nope!');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, $provider)
    {
    $providerUser = Socialite::driver($provider)->user();

    $user = User::firstOrCreate([
        'provider_id' => $providerUser->id,
        'provider' => $provider,
        'avatar' => $request->avatar,
    ], [
        'name' => $providerUser->getName(),
        'email' => $providerUser->getEmail(),
    ]);
    return redirect()->route('posts.index');
}
}

