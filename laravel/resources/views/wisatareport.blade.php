@extends('template.adminTemplate')
@section('title')
    <title>Wisata Report</title>
@endsection
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush
@section('content')
<div class="text-3xl font-bold my-5 text-center">Wisata Report</div>
<div class="text-lg font-bold my-5 text-center">Wisata History <span id="time">All Time</span></div>
<div class="flex items-center justify-center my-5">
    <div class="dropdown">
        <div tabindex="0" role="button" class="btn bg-green-secondary text-white m-1">Filter Time</div>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box">
          <button class="btn bg-green-primary text-white my-2" onclick="filter('all time',this)">All Time</button>
          <button class="btn bg-green-primary text-white my-2" onclick="filter('today',this)">Today</button>
          <button class="btn bg-green-primary text-white my-2" onclick="filter('this week',this)">This Week</button>
          <button class="btn bg-green-primary text-white my-2" onclick="filter('this month',this)">This Month</button>
        </ul>
      </div>
</div>
<div class="max-w-screen-md mx-auto bg-white p-2 rounded shadow mb-10">
    <table class="min-w-full bg-white border border-gray-300 table-auto">
        <thead>
            <tr class="bg-green-body">
                <th class="py-5 px-4 border-b">No.</th>
                <th class="py-5 px-4 border border-gray-300">Sesi</th>
                <th class="py-5 px-4 border border-gray-300">Tanggal Order</th>
                <th class="py-5 px-4 border-b">Jumlah Pemesanan</th>
            </tr>
        </thead>
        <tbody id="content">
            @include('wisatareportCard',['wisata'=>$wisata])
        </tbody>
    </table>
</div>
@endsection
@push('script')
    <script>
        function filter(time,button){
            $('#time').html(button.textContent)
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $('#content').load('/wisatareport',{
                time:time
            },function (response){
                $('#content').html(response);
            });
        }
    </script>
@endpush
