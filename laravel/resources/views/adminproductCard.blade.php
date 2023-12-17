@foreach ($products as $p )
    <div class="card card-side bg-base-100 shadow-xl p-2 my-2" onclick="product(`{{$p['product_id']}}`)">
        <figure><img src="{{$p['img_url']}}" alt="Movie" style="height:15vh;max-width:auto; padding-left:2vw;"/></figure>
        <div class="card-body">
        <h2 class="card-title">{{$p['name']}}</h2>
        <p>Click the button to view {{$p['name']}}.</p>
        </div>
  </div>
@endforeach

