<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sale;
use App\Exports\SalesExports;
class ReportController extends Controller
{
     //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("reports.index");
    }

    public function show(Request $request){
        $this->validate($request,[
            "from"=>"required",
            "to"=>"required",
        ]);

        $startDate = date("Y-m-d H:i:s", strtotime($request->from . "00:00:00"));
        $endDate = date("Y-m-d H:i:s", strtotime($request->to . "23:59:59"));
        $sales=Sale::whereBetween("updated_at",[$startDate, $endDate])
             ->where("payment_status", "paid");
        return view("reports.index")->with([
            "startDate" => $startDate,
            "endDate" => $endDate,
            "total" => $sales->sum('total'),
            "sales" => $sales->get()
        ]);
    }
    public  function generate(Request $request)
    {
       return Excel::download(new SalesExports($request->from, $request->to), "{$request->to}.xlsx");
    }
}
