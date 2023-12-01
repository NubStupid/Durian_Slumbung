@foreach ($comments as $comment)
    @include('commentCard',['comment'=>$comment])
@endforeach