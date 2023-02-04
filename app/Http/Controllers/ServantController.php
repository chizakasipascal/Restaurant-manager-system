<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServantRequest;
use App\Http\Requests\UpdateServantRequest;
use App\Models\Servant;

class ServantController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return view("servants.index")->with([
            "servants" => Servant::paginate(10);
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
         return view("servants.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServantRequest $request)
    {
         
        //validation
        $this->validate($request, [
            "name" => "required|min:3"
        ]);
        //store data
        Servants::create([
            "name" => $request->name,
            "address" => $request->address
        ]);
        //redirect user
        return redirect()->route("servants.index")->with([
            "success" => "serveur ajouté avec succés"
        ]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function show(Servant $servant)
    {
        //
        return view("servants.show")->with([
            "servant" => $servant;
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function edit(Servant $servant)
    {
        //
        return view("servants.edit")->with([
            "servant" => $servant;
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServantRequest  $request
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServantRequest $request, Servant $servant)
    {
         //validation
        $request->validate($request,[
             "name" => "required|min:3" 
        ]); 
        // store category
         
        Servant::update([
            'name' =>$request->name,
            'address' =>$request->address,
        ]);
        //redirect user
        return redirect()->route("servants.index")->with([
            "success" => "serveur modifié avec succés"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servant $servant)
    {
          //delete category
        $servant->delete();
        //redirect user
        return redirect()->route("servants.index")->with([
            "success" => "serveur supprimée avec succés"
        ]);
    }
}
