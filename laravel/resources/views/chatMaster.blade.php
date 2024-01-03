@extends('template.adminTemplate')
@section('title')
    <title>Chat Master</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endsection

@section('content')
    <body class="bg-gray-100 pb-10">

        <div class="chat max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mt-16 grid grid-rows-1 my-10">

            <!-- Header -->
            <div class="top p-4">
                <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar"
                    class="w-12 h-12 rounded-full mr-4">
                <div>
                    <p class="text-lg font-semibold">
                        @isset($toChat)
                            {{$toChat['username']}}
                        @endisset
                    </p>
                    <small class="text-gray-500">Online</small>
                </div>
            </div>
            <!-- End Header -->

            <!-- Chat -->
            <div class="messages p-4">
                <div class="left message flex items-center p-4">
                    <p class="text-gray-800 font-bold text-2xl">Current chat session (Cleared when refreshed)</p>
                </div>
            </div>
            <!-- End Chat -->

            <!-- Footer -->
            <div class="bottom p-4">
                <form>
                    <input type="text" id="message" name="message" placeholder="Enter message..."
                        class="border border-gray-300 p-2 w-3/4 rounded-l-md focus:outline-none">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-r-md">Send</button>
                </form>
            </div>
            <!-- End Footer -->

        </div>

    </body>
@endsection
@push('script')
<script>
  const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
  const channel = pusher.subscribe('public');

  //Receive messages
  channel.bind('chat', function (data) {
    $.post("/receive", {
      _token:  '{{csrf_token()}}',
      message: data.message,
    })
     .done(function (res) {
       $(".messages > .message").last().after(res);
       $(document).scrollTop($(document).height());
     });
  });

  //Broadcast messages
  $("form").submit(function (event) {
    event.preventDefault();

    $.ajax({
      url:     "/broadcast",
      method:  'POST',
      headers: {
        'X-Socket-Id': pusher.connection.socket_id
      },
      data:    {
        _token:  '{{csrf_token()}}',
        message: $("form #message").val(),
      }
    }).done(function (res) {
      $(".messages > .message").last().after(res);
      $("form #message").val('');
      $(document).scrollTop($(document).height());
    });
  });

</script>
@endpush

