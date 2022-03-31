
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
        
            <div style="text-align: center">
                <a href="" class="btn btn-success mt-5 mr-5">Export to EXCEL</a>
                <a href="{{url('/transaction/export/excel')}}" class="btn btn-success mt-5">Default</a>
                <a href="{{url('/transaction/export/excel')}}" class="btn btn-success mt-5">Sort By Proof</a>
                <a href="{{url('/transaction/export/excel')}}" class="btn btn-success mt-5">Sort By Date</a>
                <a href="{{url('/transaction/export/excel')}}" class="btn btn-success mt-5">Sort By Location</a>
                <a href="{{url('/transaction/export/excel')}}" class="btn btn-success mt-5">Sort By Code</a>
            </div>

            <div style="text-align: center">
              <a href="" class="btn btn-danger mt-3 mr-5" target="_blank">Export to PDF</a>
              <a href="{{url('/transaction/export/pdf')}}" class="btn btn-danger mt-3" target="_blank">Default</a>
              <a href="{{url('/transaction/export/pdf')}}" class="btn btn-danger mt-3" target="_blank">Sort By Proof</a>
              <a href="{{url('/transaction/export/pdf')}}" class="btn btn-danger mt-3" target="_blank">Sort By Date</a>
              <a href="{{url('/transaction/export/pdf')}}" class="btn btn-danger mt-3" target="_blank">Sort By Location</a>
              <a href="{{url('/transaction/export/pdf')}}" class="btn btn-danger mt-3" target="_blank">Sort By Code</a>
          </div>

          <div style="text-align: center">
            <a href="{{url('/transaction')}}" class="btn btn-primary mt-5">Back</a>
          </div>
        </div>
    </body>
</html>