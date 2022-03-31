<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    protected $proof;
    protected $date;
    protected $loc;
    protected $part;
    
    function __construct($proof, $date,$loc, $part) 
    {
        $this->proof = $proof;
        $this->date = $date;
        $this->part = $part;
        $this->loc = $loc;
    }
    
    public function view(): View
    {
        if($this->loc>0)
        {
            $data = Transaction::where([['item_id','like',$this->part], ['location_id','like',$this->loc], ['transaction_date','like',$this->date.'%'], ['proof','like',$this->proof.'%']])->get();
            return view('transaction_print',['data'=>$data]);
        }
        else
        {
            $data = Transaction::all();
            return view('transaction_print',['data'=>$data]);
        }
        
    }
}
