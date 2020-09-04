<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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


    public function showLoginForm()
    {
        $users = User::all();
        if(count($users)>0){
            return view('admin.users.login');
        }else{
            $user = new User();
            $user->role = 'Admin';
            $user->name = 'Jahangir';
            $user->mobile = '8801778175444';
            $user->email = 'jahangir@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();

            return view('admin.users.login');
        }
        

    }


    public function username()
    {
        return 'mobile';
        
    }


    protected function loggedOut(Request $request)
    {
        return redirect('/home');
    }


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
}
