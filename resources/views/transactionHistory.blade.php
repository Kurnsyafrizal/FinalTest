@extends('masterpage')
@section('title', 'Transaction History Page')

@section('content')
<div class="container">
    <h3 class="mt-5 mb-5">Transaksi</h3>

    <h5>FILTER</h5>
      <form action="{{url('/transaction/filter')}}" method="POST">
        @csrf
        <p>BUKTI</p>
        <select name="proof" id="proof">
          <option value="TAMBAH">TAMBAH</option>
          <option value="KURANG">KURANG</option>
        </select>

        <p>TANGGAL</p>
        <input type="date" name="date" id="date">

        <p>LOKASI</p>
        <select name="location" id="location">
          @foreach ($loc as $location)
              <option value="{{$location->id}}">{{$location->location}}</option>
          @endforeach
        </select>

        <p>KODE BARANG</p>
        <select name="part" id="part">
          @foreach ($item as $item)
              <option value="{{$item->id}}">{{$item->part}}</option>
          @endforeach
        </select>
        <br>
        <input type="submit" class="btn btn-primary mt-3 mb-3" value="Filter">
      </form>

    <div class="mb-3">
      <h5>Order By</h5>
      <h6>*note: menghilangkan filter</h6>
      <a href="{{url('/transaction')}}" class="btn btn-primary">Default</a>
      <a href="{{url('/transaction/proof')}}" class="btn btn-primary">Bukti</a>
      <a href="{{url('/transaction/date')}}" class="btn btn-primary">Tanggal Transaksi</a>
      <a href="{{url('/transaction/location')}}" class="btn btn-primary">Lokasi</a>
      <a href="{{url('/transaction/code')}}" class="btn btn-primary">Kode barang</a>
    </div>

    <table class="table mt-2s">
        <thead class="table-dark">
          <tr>
            <th scope="col">BUKTI</th>
            <th scope="col">TGL TRN</th>
            <th scope="col">JAM</th>
            <th scope="col">LOKASI</th>
            <th scope="col">KODE BARANG</th>
            <th scope="col">TGL MASUK</th>
            <th scope="col">QTY TRN</th>
            <th scope="col">UM</th>
            <th scope="col">PROGRAM</th>
            <th scope="col">USERID</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $transaction)
          <tr>
            <td>{{$transaction->proof}}</td>
            <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/y')}}</td>
            <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('H:i')}}</td>
            <td>{{$transaction->location->location}}</td>
            <td>{{$transaction->item->part}}</td>
            <td>{{\Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/y')}}</td>
            <td>{{$transaction->qty}}</td>
            <td>{{$transaction->item->um->name}}</td>
            <td>{{$transaction->program}}</td>
            <td>{{$transaction->user->name}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div style="text-align: center">
        <form action="{{url('/transaction/export/pdf')}}" method="GET">
          @csrf
          <input type="text" hidden name="partsearch" id="partsearch" value="{{isset($oldpart)?$oldpart:''}}">
          <input type="text" hidden name="locationsearch" id="locationsearch" value="{{isset($oldlocation)?$oldlocation:''}}">
          <input type="text" hidden name="datesearch" id="datesearch" value="{{isset($olddate)?$olddate:''}}">
          <input type="text" hidden name="proofsearch" id="proofsearch" value="{{isset($oldproof)?$oldproof:''}}">
          <input type="submit" class="btn btn-danger" value="EXPORT PDF">
        </form>
    
        <form action="{{url('/transaction/export/excel')}}" method="GET">
          @csrf
          <input type="text" hidden name="partsearch" id="partsearch" value="{{isset($oldpart)?$oldpart:''}}">
          <input type="text" hidden name="locationsearch" id="locationsearch" value="{{isset($oldlocation)?$oldlocation:''}}">
          <input type="text" hidden name="datesearch" id="datesearch" value="{{isset($olddate)?$olddate:''}}">
          <input type="text" hidden name="proofsearch" id="proofsearch" value="{{isset($oldproof)?$oldproof:''}}">
          <input type="submit" class="btn btn-success mt-2" value="EXPORT EXCEL">
        </form>
      </div>
</div>
    
@endsection