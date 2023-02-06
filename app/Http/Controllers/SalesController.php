<?php

namespace App\Http\Controllers;

 
use App\Table;
use App\Category;
use App\Servant;
use App\Sale;
use Illuminate\Http\Request;

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
        // $sales = Sales::orderBy("created_at", "DESC")->paginate(10);
        // return view("sales.index")->with([
        //     "sales" => $sales
        // ]);

        return view("sales.index")->with([
            "sales" => Sale::latest()->paginate(10) 
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

        return view("sales.create")->with([
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
            "total" => "required|numeric",
            // "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //store data
        $sale = new Sales();
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
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get sale to update
        $sales = Sales::findOrFail($id);
        //get sale tables
        $tables = $sales->tables()->where('sales_id', $sales->id)->get();
        //get table menus
        $menus = $sales->menus()->where('sales_id', $sales->id)->get();
        return view("sales.edit")->with([
            "tables" => $tables,
            "menus" => $menus,
            "sale" => $sales,
            "servants" => Servants::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sales
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
     * @param  \App\Sales  $sales
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
