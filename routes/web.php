<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'PageController@stock')->name('home');

//PAGE SEBELUM LOGIN
Route::get('/','PageController@start');
// Route::get('/login','PageController@login'); BAWAAN LARAVEL
Route::get('/logout','PageController@logout');
// Route::get('/register','PageController@register'); BAWAAN LARAVEL

//PAGE SESUDAH LOGIN
Route::group(['middleware'=>['auth']],function () {
    Route::get('/stock','PageController@stock');
    Route::get('/stock/add','PageController@addStock');
    Route::get('/stock/issue','PageController@issueStock');
    Route::get('/transaction','PageController@transaction');

    //FILTER DAN ORDERBY
    Route::post('/stock/filter','PageController@stockFilter');
    Route::post('/transaction/filter','PageController@transactionFilter');

    Route::get('/stock/location','PageController@stockByLocation');
    Route::get('/stock/code','PageController@stockByCode');

    Route::get('/transaction/proof','PageController@transactionByProof');
    Route::get('/transaction/date','PageController@transactionByDate');
    Route::get('/transaction/location','PageController@transactionByLocation');
    Route::get('/transaction/code','PageController@transactionByCode');

    //URL UNTUK JQUERY, DYNAMIC DROPDOWN
    Route::get('/item/{id}','PageController@getItem');

    //ROUTE RECEIPT/ISSUE
    Route::post('/stock/add','TransactionController@receipt');
    Route::post('/stock/issue','TransactionController@issue');

    //ROUTE EXPORT
    Route::get('/stock/preview', 'ExportController@stockExportPreview');
    Route::get('/stock/export/pdf', 'ExportController@stockToPdfExport');
    Route::get('/stock/export/excel', 'ExportController@stockToExcelExport');

    Route::get('/transaction/preview', 'ExportController@transactionExportPreview');
    Route::get('/transaction/export/pdf', 'ExportController@transactionToPdfExport');
    Route::get('/transaction/export/excel', 'ExportController@transactionToExcelExport');
});



