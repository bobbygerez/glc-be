<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use App\Traits\Obfuscate\Optimuss;

class ProductController extends Controller
{
    use optimuss;
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
    
        return response()->json([
            'products' => $this->product->paginate(
                $this->product->relTable()
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
    public function show($id)
    {
        
        return response()->json([
            'product' => $this->product->where('id', $id)->relTable()->first()
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
        
        return response()->json([
            'products' => \App\Model\Product::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        //
    }

    public function search(Request $request){

        return response()->json([
            'products' => $this->product->paginate(
                $this->product->when(request('catId') != 'undefined', function($q) use ($request){
                    return $q->where('category_id', $this->optimus()->encode($request->catId));
                })->where('name', 'LIKE', '%'. $request->string . '%')
                    ->relTable()
                    ->orderBy('created_at', 'desc')
                    ->get()

            )
        ]);
    }
}
