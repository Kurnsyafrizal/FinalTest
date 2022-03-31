
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EXPORT</title>

  </head>
    <body>
      <div style="text-align: center">
        <table border="2" style="border-collapse: collapse">
          <thead>
            <tr>
              <th scope="col">NO</th>
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
            @php $i=1 @endphp
            @foreach ($data as $transaction)
            <tr>
              <td>{{$i++}}</td>
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
      </div>
    </body>
</html>