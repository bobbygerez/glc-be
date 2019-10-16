<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Model\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;
use Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function reset(){

        $request = app()->make('request');
        $user = User::where('email', $request->email)->first();
        $c = str_random(64);
        
        $referer = $_SERVER['HTTP_REFERER'];

        $array = [
            'name' => $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname,
            'email' => $request->email,
            'activation_code' => $referer . '/'.$c 
        ];

        $user->activation_code = $c;
        $user->update();

        Mail::to($request->email)
            ->send(new PasswordReset($array));

        return response()->json([
            'success' => true
        ]);
    }

    public function getDetails($token){
        return response()->json([
            'user' => User::where('activation_code', $token)->first()
        ]);
        
    }

    public function newPassword($token){
        $request = app()->make('request');
        $user = User::where('activation_code', $token)->first();
        $user->password = Hash::make($request->password);
        $user->activation_code = null;
        $user->update();
        return response()->json([
            'success' => true
        ]);
    }
}
