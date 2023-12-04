@foreach ($comments->reverse() as $comment)
    @include('commentCard', ['comment' => $comment])
@endforeach
