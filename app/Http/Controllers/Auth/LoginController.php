<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\User;
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

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'status' => 1])){ 
           return $this->success('email', $request->email);
        }
        if(Auth::attempt(['username' => request('email'), 'password' => request('password'), 'status' => 1])) {
           return $this->success('username', $request->email);
        }
        else{ 
            return response()->json(['error'=>'Invalid Username or Password.'], 401); 
        } 
    }

    public function logout(Request $request) {

        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }

         return response()->json([
             'success' => true
         ]);
    }

    public function success($field, $value){
        $request = app()->make('request');
        $user = User::where($field, $value)->first(); 
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        return response()->json([
                'success' => $success,
                'user' => $user,
                'userLogin' => true
            ]); 
    }
}
