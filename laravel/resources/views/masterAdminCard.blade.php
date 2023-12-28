@foreach ($admins as $a )
    <div class="card card-side bg-base-100 shadow-xl p-2 my-2" onclick="admin(`{{$a['username']}}`)">
        <div class="card-body">
        <h2 class="card-title">{{$a['username']}}</h2>
        <p>Click the button to view {{$a['username']}}.</p>
        </div>
  </div>
@endforeach
