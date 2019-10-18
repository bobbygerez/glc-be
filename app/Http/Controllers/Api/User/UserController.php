<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Repo\User\UserInterface;
use Hash;
use Auth;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserInterface $user){

        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('index', User::class);
        $request = app()->make('request');
        return response()->json([
            'users' => $this->user->paginate( 
                $this->user->whereLike('firstname', 'like', '%' . $request->filter . '%')
                    ->orWhere('lastname', 'like', '%' . $request->filter . '%')
                    ->orderBy('created_at', 'desc')
                    ->with(['roles', 'address'])
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
        $this->authorize('index', User::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->user->store($request);
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
            'user' => $this->user->where('id', $request->id)->with(['address.brgy','address.city','address.province', 'roles', 'groups'])->first()
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
        $this->authorize('index', User::class);
        return response()->json([
            'success' => $this->user->update($request)
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
        $this->authorize('index', User::class);
        $this->user->find($request->id)->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function changePassword(Request $request){

        $user = $this->user->find($request->id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true
        ]);
    }  
    
    public function activationCode($code){

        $this->user->activationCode($code);
        
        return response()->json([
            'success' => true
        ]);
    }

    public function profileUpdate($id){

        $this->user->profileUpdate( app()->make('request') );
        return response()->json([
            'success' => true
        ]);
    }
}
