<?php

namespace App\Http\Controllers;

use App\Exports\StocksExport;
use App\Exports\TransactionExport;
use App\Stock;
use App\Transaction;
use Illuminate\Http\Request;
use PDF;
use Excel;

class ExportController extends Controller
{
    //EXPORT STOCK
    public function stockExportPreview()
    {
        $data = Stock::all();
        return view('stock_preview',['data'=>$data]);
    }

    public function stockToPdfExport(Request $request)
    {
        if($request->partsearch==null)
        {
            $data = Stock::all();
            $pdf = PDF::loadview('stock_print',['data'=>$data]);
            return $pdf->download('Stok.pdf');
        }
        else
        {
            $data = Stock::where([['item_id','like',$request->partsearch], ['location_id','like',$request->locationsearch]])->get();
            $pdf = PDF::loadview('stock_print',['data'=>$data]);
            return $pdf->download('Stok.pdf');
        }
        
    }

    public function stockToExcelExport(Request $request)
    {
        if($request->partsearch==null)
        {
            $nama_file = 'Stok.xlsx';
            return Excel::download(new StocksExport(0, 0), $nama_file);
        }
        else
        {
            $nama_file = 'Stok.xlsx';
            return Excel::download(new StocksExport($request->locationsearch, $request->partsearch), $nama_file);
        }
    }

    //EXPORT TRANSAKSI
    public function transactionExportPreview()
    {
        $data = Transaction::all();
        return view('transaction_preview',['data'=>$data]);
    }

    public function transactionToPdfExport(Request $request)
    {
        if($request->partsearch==null)
        {
            $data = Transaction::all();
            $pdf = PDF::loadview('transaction_print',['data'=>$data]);
            return $pdf->download('Transaksi.pdf');
        }
        else
        {
            $data = Transaction::where([['item_id','like',$request->partsearch], ['location_id','like',$request->locationsearch], ['transaction_date','like',$request->datesearch.'%'], ['proof','like',$request->proofsearch.'%']])->get();
            $pdf = PDF::loadview('transaction_print',['data'=>$data]);
            return $pdf->download('Stok.pdf');
        }
    }

    public function transactionToExcelExport(Request $request)
    {
        if($request->partsearch==null)
        {
            $nama_file = 'Transaksi.xlsx';
            return Excel::download(new TransactionExport(0,0,0,0), $nama_file);
        }
        else
        {
            $nama_file = 'Transaksi.xlsx';
            return Excel::download(new TransactionExport($request->proofsearch,$request->datesearch,$request->locationsearch,$request->partsearch), $nama_file);
        }
    }
}
