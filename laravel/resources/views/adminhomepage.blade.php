    @extends('template.adminTemplate')
    @section('title')
        <title>Admin Homepage</title>
    @endsection

    @section('content')
    <div class="text-3xl font-bold ps-10">Product Comparison</div>
    <div id="chart-container overflow-hidden" style="width: 100%;">
        {!! $chart->container() !!}
    </div>
    <div class="text-3xl font-bold ps-10 mt-10">Last Few Products Sold (5 Latest Transaction)</div>
    <div class="grid grid-cols-2 justify-items-center">
        @foreach($latestTrans as $trans)
            <div class="card card-side bg-base-100 h-72 shadow-xl w-4/5 m-10">
                @if ($trans['product']['img_url'])
                    <figure><img src="{{$trans['product']['img_url']}}" alt="iProduct"/></figure>
                @else
                    <figure><img src="{{asset('assets/wisata/olahan/'.$trans['product']['img'])}}" alt="iProduct"/></figure>
                @endif
                <div class="card-body">
                <h1 class="card-title text-3xl">{{$trans['product']['name']}}</h1>
                <p> QTY : {{$trans['qty']}} pcs</p>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="grid grid-cols-2 gap-4 p-20" style="width: 100%;">
        <div class="p-6 bg-white rounded shadow">
        </div>
    </div> --}}

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <style>
        @media screen and (max-width: 600px) {
            #chart-container {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
    @endsection
