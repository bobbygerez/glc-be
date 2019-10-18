<?php

namespace App\Http\Controllers\Api\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Traits\Obfuscate\Optimuss;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductController extends Controller
{

    use Optimuss;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $products = Product::whereHas('groups', function($q) use ($request){
            $q->where('groups.id', $this->removeStringEncode($request->groupId) );
        })->when($request->categoryId != '', function($q) use ($request) {
            $q->where('category_id', '=', $this->removeStringEncode($request->categoryId) );
        })->when($request->catalogId != '', function($q) use ($request) {
            $q->where('catalog_id', '=', $this->removeStringEncode($request->catalogId) );
        })
        ->with(['images'])
        ->orderBy('name', 'asc')->get();

        return response()->json([
            'products' => $this->paginate( $products )
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paginate($collection)
    {
        if ($collection !== null) {
            $request = app()->make('request');
            $perPage = $request->perPage === '0' ? $collection->count() : $request->perPage;

            return new LengthAwarePaginator($collection->forPage($request->page, $perPage), $collection->count(), $perPage, $request->page);
        }
    }
}
