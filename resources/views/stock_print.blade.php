
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
        </div>
    </body>
</html>