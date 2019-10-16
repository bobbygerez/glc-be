<?php

namespace App\Http\Controllers\Api\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use Auth;

class MenuController extends Controller
{
    
    public function index(){
        return response()->json([
            'menus' => Menu::all()->map(function($v){
                return $v->only('label', 'value');
            })->values()->all()
        ]);
    }
}
