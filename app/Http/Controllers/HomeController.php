<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistration;

class HomeController extends Controller
{
    

    public function mail()
    {
    $name = 'Krunal';
    Mail::to('bobby.gerez@yahoo.com')
        ->send(new UserRegistration($name));
    
    return 'Email was sent';
    }
}
