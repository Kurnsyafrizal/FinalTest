<?php

namespace App\Exports;

use App\Stock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StocksExport implements FromView
{
    protected $loc;
    protected $part;
    function __construct($loc, $part) 
    {
        $this->part = $part;
        $this->loc = $loc;
    }
    
    public function view(): View
    {
        if($this->loc>0)
        {
            $data = Stock::where([['item_id','like',$this->part], ['location_id','like',$this->loc]])->get();
            return view('stock_print',['data'=>$data]);
        }
        else
        {
            $data = Stock::all();
            return view('stock_print',['data'=>$data]);
        }
        
    }
}
