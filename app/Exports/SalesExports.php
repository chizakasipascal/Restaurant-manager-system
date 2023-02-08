<?php

namespace App\Exports;

use App\Models\sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\SalesExports;
class SalesExports implements FromView
{

    private $to;
    private $from;
    private $sales;
    private $total;


    public function __construct($from,$to){
        $this->to = $to; 
        $this->from = $from;
        $this->sales=Sale::whereBetween("updated_at",[$from, $to])
            ->where("payment_status", "paid")-get(); 
       $this->total = $this->sales->sum("total");

    }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return sale::all();
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('reports.export', [
            'total' => $this->total,
            'sales' => $this->sales,
            'startDate' => $this->from,
            'endDate' => $this->to,
        ]);
    }
}
