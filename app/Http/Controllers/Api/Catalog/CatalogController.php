<?php

namespace App\Http\Controllers\Api\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog;
use App\Repo\Catalog\CatalogInterface;

class CatalogController extends Controller
{

    protected $catalog;
    public function __construct(CatalogInterface $catalog){

        $this->catalog = $catalog;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $this->authorize('index', Catalog::class);
        return response()->json([
            'catalogs' =>  $this->catalog->index( app()->make('request') ),
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
        $this->authorize('index', Catalog::class);
        $this->catalog->create( $request->all() );
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('index', Catalog::class);
        $c = $this->catalog->find($request->id);
        return response()->json([
            'catalog' => $c
        ]);
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
        $this->authorize('index', Catalog::class);
        $c = $this->catalog->where('id', $request->optimus_id)->first();
        $c->update( $request->all() );
        return response()->json([
            'success' => true
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
        $this->authorize('index', Catalog::class);
         $c = $this->catalog->where('id', $request->id)->first();
         $c->delete();
         return response()->json([
            'success' => true
        ]);
    }
}
