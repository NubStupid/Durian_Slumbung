<div class="col card p-2 mx-5 my-3" style="width: 18rem;">
    <div class="row d-flex justify-content-center">
        <img src="{{$products[$i-1]->img_url}}" class="card-img-top" alt="..." style="max-width:7rem;max-height:auto;">
    </div>
    <div class="card-body">
        <h5 class="card-title">{{$products[$i-1]->name}}</h5>
        <hr>
        <p class="card-text ">
            @php
                $arrDesc = explode(' ',$products[$i-1]->description);
                if(count($arrDesc)>=10){
                    for ($j=0; $j < 10 ; $j++) {
                        echo $arrDesc[$j]." ";
                    }
                    echo "...";
                }else{
                    echo $products[$i-1]->description;
                }
            @endphp
        </p>
        <div class="" style="font-size:1.1rem">Rating : {{$products[$i-1]->rating}}/5 ⭐</div>
        <div class="mb-3" style="font-size:1.1rem">Rp. {{$products[$i-1]->price}}</div>
        <div class="my-4"></div>
        <a href="#" class="position-absolute btn bg-green-primary text-white fw-semibold" style="bottom:1vh;left:1vw;">More Detail</a>
    </div>
</div>
