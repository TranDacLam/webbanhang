<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Socialite;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        // return $user->name;  
        $findUser = User::where('email',$userSocial->email)->first();

        if($findUser){
            Auth::login($findUser);
        }else{
            $user = new User;
            $user->full_name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(121212);
            $user->facebook_id = $userSocial->id;
            $user->save();
            Auth::login($user);            
        }
        return redirect()->route('getIndex')->with(['flash_level' => 'result_msg','flash_message' => 'Đăng nhập thành công']);
    }
}
