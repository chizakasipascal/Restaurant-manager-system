<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("agent.index")->with([
            "agent" => User::paginate(10)
        ]);

    }


     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create()
    {
        return view("agent.create");
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       //validation
        $this->validate($request, [
            "name" => "required|unique:users,name",
            "email"=>"required|unique:users,email",
            // "role" => "required"
        ]);
        //store data
        $name=$request->name;

        User::create([
            // "user_id"=>Auth::user()->id,
            'name' =>  $name ,
            'email' => $request->email,
            'role' => 'block',
            'password' => Hash::make($request->password),
        ]);
        //redirect user
        return redirect()->route("agent.index")->with([
            "success" => "taUserble ajoutée avec succés"
        ]);
    }
    /**
     *update  a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
     public function update(UserRequest $request )
     {
         //validation
        $this->validate($request, [
            "name" => "required",
            "role" => "required"
        ]);
        $userUpdated = User::find($request->id);

         $userUpdated->update($request->all());

if ($request->role=="block") {
  return
          redirect()->route("agent.index")->with([
            "success" => "User modifiée avec block "
        ]);
}else{
return
          redirect()->route("agent.index")->with([
            "success" => "User modifiée avec succés"
        ]);
}


    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $agent)
    {
        //
        return view("agent.edit")->with([
            "agent" => $agent
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $user)
    {


        // // $user->delete();
        //  $userUpdated = User::find($user->id);

        // return
        //   redirect()->route("agent.index")->with([
        //     "success" => "User supprimée avec succés"
        // ]);
    }
}
