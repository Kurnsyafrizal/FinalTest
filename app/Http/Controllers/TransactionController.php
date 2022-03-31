<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function receipt(Request $request)
    {
        DB::table('transactions')->insert([
            //Carbon::now(UTC +7) untuk WIB
            ['transaction_date'=>Carbon::now(), 
            'proof'=>$request->proof,
            'location_id'=>$request->location, 
            'item_id'=>$request->part, 
            'qty'=>$request->qty, 
            'program'=>'RECEIPT', 
            'user_id'=>Auth::user()->id ,
            'created_at'=>Carbon::now()]
        ]);

        //CEK DI STOK, KALAU ADA EDIT, KALAU TDK ADA INSERT LALU REDIRECT KE STOCK
        $now = Carbon::parse(Carbon::now())->format('Y-m-d');
        $stock = Stock::where([['transaction_date','like',$now."%"], ['item_id','like',$request->part], ['location_id','like',$request->location]])->first();
        if($stock->id==null)
        {
            DB::table('stocks')->insert([
                ['location_id'=>$request->id, 
                'item_id'=>$request->part, 
                'stored'=>$request->qty, 
                'transaction_date'=>Carbon::now(),
                'created_at'=>Carbon::now()],
            ]);
        }
        else
        {
            $stock->stored = $stock->stored+$request->qty;
            $stock->save();
        }
        // dd($stock);

        

        return redirect('/stock');
    }

    public function issue(Request $request)
    {
        $req = $request->qty;
        $stock = Stock::where([['item_id','like',$request->part], ['location_id','like',$request->location]])->get();
        $sum = $stock->sum('stored');
        // dd($request->proof);
        if($sum<$req)
        {
            $message = "ERROR, Stok Tidak Cukup!!!";
            return redirect('/stock/issue');
        }
        else
        {
            while($req>0)
            {
                $current_stock = Stock::where([['item_id','like',$request->part], ['location_id','like',$request->location]])->first();
                //KALAU STOK > REQUEST, POTONG STOK DENGAN REQUEST LALU SELESAI
                if($current_stock->stored>$req)
                {
                    $current_stock->stored = $current_stock->stored-$req;
                    $current_stock->save();

                    DB::table('transactions')->insert([
                        //Carbon::now(UTC +7) untuk WIB
                        ['transaction_date'=>Carbon::now(), 
                        'proof'=>$request->proof,
                        'location_id'=>$request->location, 
                        'item_id'=>$request->part, 
                        'qty'=>($req*-1), 
                        'program'=>'ISSUE', 
                        'user_id'=>Auth::user()->id ,
                        'created_at'=>Carbon::now()]
                    ]);
                    $req=0;
                }
                //KALAU STOK = REQUEST, POTONG STOK DENGAN REQUEST, DELETE STOK LALU SELESAI
                else if($current_stock->stored==$req)
                {
                    $current_stock->delete();

                    DB::table('transactions')->insert([
                        //Carbon::now(UTC +7) untuk WIB
                        ['transaction_date'=>Carbon::now(), 
                        'proof'=>$request->proof,
                        'location_id'=>$request->location, 
                        'item_id'=>$request->part, 
                        'qty'=>($request->qty*-1), 
                        'program'=>'ISSUE', 
                        'user_id'=>Auth::user()->id ,
                        'created_at'=>Carbon::now()]
                    ]);
                    $req=0;
                }
                //KALAU STOK < REQUEST, POTONG REQUEST DENGAN STOK, LANJUT KE STOK BERIKUT
                else
                {
                    $req=$req-$current_stock->stored;
                    
                    
                    DB::table('transactions')->insert([
                        //Carbon::now(UTC +7) untuk WIB
                        ['transaction_date'=>Carbon::now(), 
                        'proof'=>$request->proof,
                        'location_id'=>$request->location, 
                        'item_id'=>$request->part, 
                        'qty'=>($current_stock->stored*-1), 
                        'program'=>'ISSUE', 
                        'user_id'=>Auth::user()->id ,
                        'created_at'=>Carbon::now()]
                    ]);
                    $current_stock->delete();
                }
            }
        }
        return redirect('/stock');
    }
}
