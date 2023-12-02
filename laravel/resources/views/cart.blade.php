@extends('template.customerTemplate')
@section('title')
    <title>Cart</title>
    @php
        $title = "Cart";
    @endphp
@endsection

@push('style')
@endpush
@section('content')
    @foreach($listproduct as $data)
        @foreach($listcart as $cekdata)
            @if($data->product_id == $cekdata->product_id)
                <div class="px-5 row" style="background-color:">
                    <div class="col-5">
                        <img src="{{$data->img_url}}" alt="">
                    </div>
                    <div class="col-3">
                        <h5>
                            {{$data->name}}
                        </h5>
                    </div>
                    <div class="col-">

                    </div>
                </div>
                @break
            @endif
        @endforeach
    @endforeach
@endsection
@push('script')
    <script>
    </script>
@endpush
