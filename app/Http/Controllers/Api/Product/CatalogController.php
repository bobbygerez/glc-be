<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog;

class CatalogController extends Controller
{
    public function index(){
        return response()->json([
            'catalogs' => Catalog::orderBy('name', 'asc')->get()
        ]);
    }
}
