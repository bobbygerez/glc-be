<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;

class GroupController extends Controller
{
    
    public function index(){
        return response()->json([
            'groups' => Group::all()
        ]);
    }
}
