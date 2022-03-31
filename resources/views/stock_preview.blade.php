
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
                    <th scope="col">LOKASI</th>
                    <th scope="col">KODE BARANG</th>
                    <th scope="col">NAMA BARANG</th>
                    <th scope="col">SALDO</th>
                    <th scope="col">UM</th>
                    <th scope="col">TGL MASUK</th>
                  </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                  @foreach ($data as $stock)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$stock->location->location}}</td>
                    <td>{{$stock->item->part}}</td>
                    <td>{{$stock->item->desc}}</td>
                    <td>{{$stock->stored}}</td>
                    <td>{{$stock->item->um->name}}</td>
                    <td>{{\Carbon\Carbon::parse($stock->transaction_date)->format('d/m/y')}}</td>
                    
                  </tr>
                  @endforeach
                </tbody>
            </table>
        
            <div style="text-align: center">
                <a href="{{url('/stock/export/excel')}}" class="btn btn-success mt-5 mr-2">Export to EXCEL</a>
                <a href="{{url('/stock/export/pdf')}}" class="btn btn-danger mt-5" target="_blank">Export to PDF</a>
            </div>

          <div style="text-align: center">
            <a href="{{url('/stock')}}" class="btn btn-primary mt-5">Back</a>
          </div>
        </div>
    </body>
</html>