@extends('masterpage')
@section('title', 'Add Stock Page')

@section('content')

<div class="container form-control mt-5" style="text-align: center">
    <h3>Adding Stock</h3>
    <form action="{{url('/stock/add')}}" method="POST">
        @csrf
        <p>Bukti:</p>
        <input type="text" id="proof" name="proof" readonly class="form-control mb-3" style="width: 25%;margin-left: 37.5%" value="TAMBAH{{$count}}">

        <p>Lokasi:</p>
        <select name="location" id="location">
            @foreach ($locations as $location)
                <option value="{{$location->id}}">{{$location->location}}</option>    
            @endforeach
        </select>

        <p class="mt-5">Kode Barang:</p>
        <select name="part" id="part">
            @foreach ($items as $item)
                <option value="{{$item->id}}">{{$item->part}}</option>    
            @endforeach
        </select>

        <p class="mt-5">Nama Barang:</p>
        <input type="text" id="desc" name="desc" class="form-control mb-3" style="width: 25%;margin-left: 37.5%" readonly>

        <p>Quantity:</p>
        <input type="number" id="qty" name="qty" class="form-control mb-3" style="width: 25%;margin-left: 37.5%">

        <p>Satuan:</p>
        <select name="um" id="um">
            @foreach ($ums as $um)
                <option value="{{$um->id}}">{{$um->name}}</option>    
            @endforeach
        </select>

        <br><br>
        <input type="submit" class="btn btn-primary" value="Add">
    </form>
</div>

<script>
    $(function(){
        $('select[name=part]').ready(function() 
        {
            var url = '{{ url('/item/'.(count($items) > 0 ? $items[0]->id : '')) }}';
            console.log(url);
            
            $.get(url, function(data) 
            {
                var inputbox = $('form input[name=desc]');

                console.log(inputbox);
                inputbox.val(data['desc']);
            });
        });
    });

    $(function() 
    {
        $('select[name=part]').change(function() 
        {
            var url = '{{ url('/item') }}' +'/'+ $(this).val();
            console.log(url);
            
            //$ = JQUERY
            $.get(url, function(data) 
            {
                var inputbox = $('form input[name=desc]');

                console.log(inputbox);
                inputbox.val(data['desc']);
                

                // $.each(data,function(key, value) 
                // {
                //     select.append('<option value=' + value.id + '>' + value.name + '</option>');
                // });
            });
        });
    });
</script>
    
@endsection