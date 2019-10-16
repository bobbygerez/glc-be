<?php

namespace App\Http\Controllers\Api\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;
use App\Repo\Group\GroupInterface;
class GroupController extends Controller
{

    protected $group;
    public function __construct(GroupInterface $group){

        $this->group = $group;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'groups' =>  $this->group->index( app()->make('request') ),
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
        $this->group->create( $request->all() );
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
        
        return response()->json([
            'group' => $this->group->find($request->id)
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
        $g = $this->group->where('id', $request->optimus_id)->first();
        $g->update($request->all());
        return response()->json([
            'success' => $g 
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
        $g = $this->group->find($request->id);
        $g->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
