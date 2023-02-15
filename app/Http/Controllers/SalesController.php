<?php

namespace App\Http\Controllers;


use App\Models\Sale;
use App\Models\Table;
use App\Models\Servant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $sales = Sale::orderBy("created_at", "DESC")->paginate(10);
        return view("sales.index")->with([
            "sales" => Sale::paginate(10)
        ]);

        // return view("sales.index")->with([
        //     "sales" => Sale::latest()->paginate(10)
        // ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("sales.create")->with([
            "user_id"=>Auth::user()->id,
            "tables" => Table::all(),
            "categories"=>Category::all(),
            "servants"=>Servant::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [

            "table_id" => "required",
            "menu_id" => "required",
            "servant_id" => "required",
            "quantity" => "required|numeric",
            // "total" => "required|numeric",
            // "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //store data
        $sale = new Sale();
        $sale->user_id = Auth::user()->id;
        $sale->servant_id = $request->servant_id;
        $sale->quantity = $request->quantity;
        $sale->price = $request->price;
        $sale->total = $request->total;
        $sale->change = $request->change;
        $sale->payment_status = $request->payment_status;
        $sale->payment_type = $request->payment_type;
        $sale->save();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);
        $sale->tables()->update([
            "status" => 0,
        ]);

        //redirect user
        return redirect()->back()->with([
            // "success" => "Paiement effectué avec succés"
              "success" => "Menu ajouter avec succés"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale   $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //get sale to update
        // $sales = Sales::findOrFail($id);
        //get sale tables
        $tables = $sale->tables()->where('sale_id', $sale->id)->get();
        //get table menus
        $menus = $sale->menus()->where('sale_id', $sale->id)->get();
        return view("sales.edit")->with([
            "tables" => $tables,
            "menus" => $menus,
            "sale" => $sale,
            "servants" => Servant::all()
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale   $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //validation
        $this->validate($request, [
            "table_id" => "required",
            "menu_id" => "required",
            "servant_id" => "required",
            "quantity" => "required|numeric",
            "total" => "required|numeric",
            // "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //get sale to update
        // $sale = Sales::findOrFail($sale);
        //update data
        $sale->user_id = Auth::user()->id;
        $sale->servant_id = $request->servant_id;
        $sale->quantity = $request->quantity;
        $sale->total = $request->total;
        $sale->total = $request->total;
        $sale->change = $request->change;
        $sale->payment_status = $request->payment_status;
        $sale->payment_type = $request->payment_type;
        $sale->update();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);

        //redirect user
        return redirect()->back()->with([
            // "success" => "Paiement modifié avec succés"

            "success" => "Menu ajouter avec succés"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale   $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->tables()->update([
            "status" => 1,
        ]);

        //get sale to update
        // $sale = Sales::findOrFail($id);
        //delete sales
        $sale->delete();
        //redirect user
        return redirect()->back()->with([
            // "success" => "Paiement supprimé avec succés"
            "success" => "Menu supprimé avec succés"
        ]);
    }
}
