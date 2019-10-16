<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UsernameRequest;
use App\Http\Requests\User\EmailRequest;
use App\Http\Requests\User\MobileRequest;
class UserValidationController extends Controller
{
    public function userName(UsernameRequest $request){

    }

    public function email(EmailRequest $request){

    }

    public function mobile(MobileRequest $request){

    }
}
