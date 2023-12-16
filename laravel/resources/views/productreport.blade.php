@extends('template.adminTemplate')
@section('title')
    <title>Product Report</title>
@endsection

@section('content')
<div class="text-3xl font-bold my-10 text-center">Product Report</div>
<div class="flex items-center justify-center">

</div>
<div class="max-w-screen-md mx-auto bg-white p-2 rounded shadow mb-10">
    <table class="min-w-full bg-white border border-gray-300 table-auto">
        <thead>
            <tr class="bg-green-body">
                <th class="py-5 px-4 border-b">No.</th>
                <th class="py-5 px-4 border border-gray-300">Products Name</th>
                <th class="py-5 px-4 border border-gray-300">Price</th>
                <th class="py-5 px-4 border border-gray-300">Rating</th>
                <th class="py-5 px-4 border-b">Sales</th>
            </tr>
        </thead>
        <tbody>
            @for ($i =1 ; $i <= count($products) ; $i++)
            <tr class="">
                <td class="py-2 px-4 border-b text-center">{{$i}}</td>
                <td class="py-2 px-4 border border-gray-300 text-center">
                    <div class="flex items-center justify-start">
                        <div class="flex-shrink-0 w-32 h-32">
                            <img class="w-full h-full object-cover" src="{{ $products[$i-1]['product']['img_url'] }}" alt="Product Image">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">{{ $products[$i-1]['product']['name'] }}</p>
                        </div>
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-center">Rp. {{$products[$i-1]['product']['price']}}</td>
                <td class="py-2 px-4 border-b text-center">{{$products[$i-1]['product']['rate']}}⭐</td>
                <td class="py-2 px-4 border-b text-center">{{$products[$i-1]['qty']}} pcs</td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection
