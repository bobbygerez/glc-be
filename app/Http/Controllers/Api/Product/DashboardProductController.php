<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use App\Model\Product;
use Auth;

class DashboardProductController extends Controller
{
    protected $product;

    public function __construct(ProductInterface $product){
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Product::class);
        $request = app()->make('request');
        return response()->json([
            'products' => $this->product->paginate(
                $this->product->index($request)
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('index', Product::class);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->authorize('index', Product::class);

        return response()->json([
            'images' => $this->product->create($request)
        ]);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        $this->authorize('index', Product::class);
        return response()->json([
            'product' => $this->product->where('id', $request->id)->relTable()->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        $this->authorize('index', Product::class);
        return $this->product->edit($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productUpdate(Product $product, Request $request)
    {

        return response()->json([
            'success' => $this->product->update($request)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->authorize('index', Product::class);
        $this->product->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
