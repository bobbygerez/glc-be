<?php 

namespace App\Repo\User;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\User;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistration;

class UserRepository extends BaseRepository implements UserInterface{


    public function __construct(){

        $this->modelName = new User();
    
    }

    public function index($request){
       

        // $branches = $this->whereLike('name', 'like', '%' . $request->filter . '%')
        //     ->orWhere('lastname', 'like', '%' . $request->filter . '%')
        //     ->when(!in_array(0, Auth::User()->roles->pluck('parent_id')->toArray()), function($q){
        //         $q->where('user_id', Auth::User()->id);
        //     })
        //     ->with('user')
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        // return $this->paginate($branches);

       
    }

    public function update($request){

        $user = $this->find($request->id);
        $user->address()->updateOrCreate($request->address);
        $user->roles()->sync($request->roles);
        $user->update( $request->all() );

        return true;

    }

    public function store($request){

        $newRequest = $request->all();
        $c = str_random(32);
        $newRequest['activation_code'] = $c;
        $newRequest['password'] = Hash::make($request->password);
        $newUser = $this->create( $newRequest);
        $newUser->roles()->attach($newUser->id, [
            'role_id' => 2,
            'user_id' => $newUser->id
        ]);
        $referer = $_SERVER['HTTP_REFERER'];

        $array = [
            'name' => $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname,
            'email' => $request->email,
            'activation_code' => $referer . '/activation_code/'.$c 
        ];


        Mail::to($request->email)
            ->send(new UserRegistration($array));
    } 
    
    public function activationCode($code){
        $user = $this->modelName->where('activation_code', '=', $code)->first();
        $user->status = 1;
        $user->activation_code = null;
        $user->update();
    }

    
    public function profileUpdate($request){

        $user = $this->find($request->id);
        $user->address()->updateOrCreate($request->address);
        $user->update( $request->all() );
    }

}