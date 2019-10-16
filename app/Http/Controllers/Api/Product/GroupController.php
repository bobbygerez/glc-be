<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;

class GroupController extends Controller
{
    
    public function index(){
        return response()->json([
            'groups' => Group::orderBy('name', 'asc')->get()
        ]);
    }
}
