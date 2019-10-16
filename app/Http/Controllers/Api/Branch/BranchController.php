<?php

namespace App\Http\Controllers\Api\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Branch;
use Auth;
use App\Repo\Branch\BranchInterface;
class BranchController extends Controller
{
    protected $branch;
    public function __construct(BranchInterface $branch){

        $this->branch = $branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Branch::class);
        $request = app()->make('request');
        return response()->json([
            'branches' => $this->branch->index($request)
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
        $this->authorize('index', Branch::class);
        $this->branch->create($request);
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
    public function show(Request $request)
    {
        $this->authorize('index', Branch::class);
        return response()->json([
            'branch' => $this->branch->find($request->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $this->authorize('index', Branch::class);
        return response()->json([
            'branch' => $this->branch->find($request->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('index', Branch::class);
        $this->branch->find($request->optimus_id)->update($request->all());
        return response()->json([
            'store' => $this->branch->find($request->optimus_id)
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
        $this->authorize('index', Branch::class);
        $this->branch->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function getStores(){

        return response()->json([
            'stores' => $this->branch->getStores()
        ]);
        
    }
}
