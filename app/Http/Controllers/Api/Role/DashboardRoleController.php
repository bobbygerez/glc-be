<?php

namespace App\Http\Controllers\Api\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Role\RoleInterface;
use App\Http\Requests\RoleFormRequest;
use Auth;
use App\Model\Role;

class DashboardRoleController extends Controller
{

    protected $role;
    public function __construct(RoleInterface $role){
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Role::class);
        $request = app()->make('request');
        return response()->json([
            'roles' => $this->role->paginate( 
                $this->role->whereLike('name', 'like', '%' . $request->filter . '%')
                    ->orWhere('description', 'like', '%' . $request->filter . '%')
                    ->where('parent_id')
                    ->with('allChildren')
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
        
        $this->authorize('index', Role::class);
        $role = Auth::User()->roles->min('parent_id');
        $roles = $this->role->all()->map(function($v){
                return $v->only('value', 'label', 'parent_id');
            })->filter(function($v) use ($role) {
                return $v['parent_id'] > $role;
            })->values()->all();

        return response()->json([
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        $this->authorize('index', Role::class);
        $this->role->store($request);

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
        $this->authorize('index', Role::class);

        $role = $this->role->where('id', $request->id)->with(['parent', 'menus'])->first();
        
        $roles = $this->role->all()->map(function($v){
                return $v->only('value', 'label', 'parent_id');
            })->filter(function($v) use ($role) {
                return $v['parent_id'] < $role->parent_id;
            })->values()->all();

        return response()->json([
            'role' => $role,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, $id)
    {
        $this->authorize('index', Role::class);
        return response()->json([
            'success' => $this->role->updateRole( $request )
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
        $this->authorize('index', Role::class);
        $this->role->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
