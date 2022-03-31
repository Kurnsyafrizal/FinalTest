<?php

namespace App\Http\Controllers;

use App\MasterItem;
use App\MasterLocation;
use App\Stock;
use App\Transaction;
use App\Um;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //REDIRECT PAGE
    public function stock()
    {  
        $data = Stock::all();
        $loc = MasterLocation::all();
        $item = MasterItem::all();
        return view('stock',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function stockFilter(Request $request)
    {
        $loc = MasterLocation::all();
        $item = MasterItem::all();
        $data = Stock::where([['item_id','like',$request->part], ['location_id','like',$request->location]])->get();
        return view('stock',['data'=>$data,'loc'=>$loc,'item'=>$item, 'oldpart'=>$request->part, 'oldlocation'=>$request->location]);
    }

    public function stockByLocation()
    {
        $loc = MasterLocation::all();
        $item = MasterItem::all();
        $data = Stock::orderBy('location_id')->get();
        return view('stock',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function stockByCode()
    {
        $loc = MasterLocation::all();
        $item = MasterItem::all();
        $data = Stock::orderBy('item_id')->get();
        return view('stock',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function start()
    {
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function addStock()
    {
        $locations=MasterLocation::all();
        $items=MasterItem::all();
        $ums = Um::all();

        $data = Transaction::where('program','like','RECEIPT')->get();

        if($data==null)
            $count = 1;
        else
        {
            $count = $data->count()+1;
        }

        
        
        return view('addStock', ['count'=>$count, 'locations'=>$locations, 'items'=>$items, 'ums'=>$ums]);
    }

    public function getItem($id)
    {
        $data = MasterItem::find($id);

        return $data; //SDH BENTUK JSON
    }

    public function issueStock()
    {
        $locations=MasterLocation::all();
        $items=MasterItem::all();
        $ums = Um::all();

        $data = Transaction::where('program','like','ISSUE')->latest('created_at')->first();
        
        if($data==null)
            $count = 1;
        else
        {
            $str = $data->proof;
            $str = str_replace("KURANG","",$str);
            $count = $str+1;
            // dd($count);
        }
            

        return view('issueStock', ['count'=>$count, 'locations'=>$locations, 'items'=>$items, 'ums'=>$ums]);
    }

    public function transaction()
    {
        $data = Transaction::all();
        // $proof = DB::table('transactions')->select('proof')->groupBy('proof')->get();
        $loc = MasterLocation::all();
        $item = MasterItem::all();
        return view('transactionHistory',['data'=>$data, 'loc'=>$loc,'item'=>$item]);
    }

    public function transactionFilter(Request $request)
    {
        $data = Transaction::where([['item_id','like',$request->part], ['location_id','like',$request->location], ['transaction_date','like',$request->date.'%'], ['proof','like',$request->proof.'%']])->get();
        // dd($data);
        $loc=MasterLocation::all();
        $item=MasterItem::all();
        // dd($proof);
        return view('transactionHistory',['data'=>$data,'loc'=>$loc,'item'=>$item, 'oldpart'=>$request->part, 'oldlocation'=>$request->location, 'olddate'=>$request->date, 'oldproof'=>$request->proof]);
    }

    public function transactionByProof()
    {
        $loc=MasterLocation::all();
        $item=MasterItem::all();
        $data = Transaction::orderBy('proof','DESC')->get();
        return view('transactionHistory',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function transactionByDate()
    {
        $loc=MasterLocation::all();
        $item=MasterItem::all();
        $data = Transaction::orderBy('transaction_date')->get();
        return view('transactionHistory',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function transactionByLocation()
    {
        $loc=MasterLocation::all();
        $item=MasterItem::all();
        $data = Transaction::orderBy('location_id')->get();
        return view('transactionHistory',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }

    public function transactionByCode()
    {
        $loc=MasterLocation::all();
        $item=MasterItem::all();
        $data = Transaction::orderBy('item_id')->get();
        return view('transactionHistory',['data'=>$data,'loc'=>$loc,'item'=>$item]);
    }
}
