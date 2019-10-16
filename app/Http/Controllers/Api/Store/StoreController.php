<?php

namespace App\Http\Controllers\Api\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Store;
use App\Repo\Store\StoreInterface;
use Auth;

class StoreController extends Controller
{

    protected $store;
    public function __construct(StoreInterface $store){

        $this->store = $store;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = app()->make('request');
        
        return response()->json([
            'stores' => $this->store->paginate(
                $this->store->whereLike('name', 'like', '%' . $request->filter . '%')
                ->when(Auth::User()->isSuperAdmin() === false, function($q){
                   $q->where('user_id', Auth::User()->id);
                })
                ->with('users')
                ->orderBy('created_at', 'desc')
                ->get()
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
        $this->store->create($request);
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
        return response()->json([
            'store' => $this->store->find($request->id)
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
        return response()->json([
            'store' => $this->store->find($request->id)
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
        $this->store->find($request->optimus_id)->update($request->all());
        return response()->json([
            'store' => $this->store->find($request->optimus_id)
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
        $this->store->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
