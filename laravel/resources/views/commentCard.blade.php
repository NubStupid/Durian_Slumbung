<div class="row py-2">
    <div class="ms-1 row pe-1" style="min-height: 3.15rem">
        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Jamal_Edwards%2C_2019.png" class="col-2 bg-blue-dark rounded-circle me-2" style="max-height: 3.15rem" alt=""> 
        <div class="col-9 bg-blue-light py-2 text-wrap rounded-2" style="font-size:0.75em;">{{$comment->message}}</div>
    </div>
    <div class="row d-flex justify-content-end align-items-center">
        <div class="col-1">
            <img src="{{asset($comment->img_like)}}" alt="" style="max-width:1rem; max-height:auto;" onclick="like(this)" id="{{$comment->comment_id}}">
        </div>
        <div class="pt-1 col-3 d-flex justify-content-end">
        <span class="{{$comment->comment_id}}_likes">{{$comment->likes}}</span>
        </div>
    </div>
</div>
