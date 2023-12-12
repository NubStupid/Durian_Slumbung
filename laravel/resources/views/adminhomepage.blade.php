    @extends('template.adminTemplate')
    @section('title')
        <title>Admin Homepage</title>
    @endsection

    @section('content')
    <div class="text-3xl font-bold ps-10">Product Comparison</div>
    <div id="chart-container overflow-hidden" style="width: 100%;">
        {!! $chart->container() !!}
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
