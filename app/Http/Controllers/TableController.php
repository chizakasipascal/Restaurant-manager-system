<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Support\Str;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;

class TableController extends Controller
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
        return view("tables.index")->with([
            "tables" =>Table::paginate(10)
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
         return view("tables.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTableRequest $request)
    {
       //validation
        $this->validate($request, [
            "name" => "required|unique:tables,name",
            "status" => "required|boolean"
        ]);
        //store data
        $name=$request->name;
        Table::create([
            "name" =>  $name ,
            "slug" => Str::slug($name),
            "status" => $request->status,
        ]);
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "table ajoutée avec succés"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
         return view("tables.show")->with([
            "tables" => $table
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
         return view("tables.edit")->with([
            "tables" => $table
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        //
         //validation
        $this->validate($request, [
            "name" => "required|unique:tables,name," . $table->id,
            "status" => "required|boolean"
        ]);
        //store data
         $name = $request->name;
        $table->update([
            "name" => $name,
            "slug" => Str::slug($name),
            "status" => $request->status,
        ]);
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "table modifiée avec succés"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
        $table->delete();
        //redirect user
        return redirect()->route("tables.index")->with([
            "success" => "table supprimée avec succés"
        ]);
    }
}
