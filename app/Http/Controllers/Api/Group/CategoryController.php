<?php

namespace App\Http\Controllers\Api\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class CategoryController extends Controller
{
    public function index(){

        return response()->json([
            'categories' => Category::all()
        ]);
    }
}
