<div class="col card p-2 mx-5 my-3" style="width: 18rem;">
    <div class="row d-flex justify-content-center">
        <img src={{$products[$i-1]->img_url}} class="card-img-top" alt="..." style="max-width:10rem;max-height:auto;">
    </div>
    <div class="card-body">
        <h5 class="card-title row">
            <div class="col-9">
                {{$products[$i-1]->name}}
            </div>
            <div class="col-3 d-flex align-items-center">
                @if($products[$i-1]->rate != null)
                {{$products[$i-1]->rate}}⭐
                @else
                    -⭐
                @endif
            </div>
        </h5>
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
        {{-- <div class="" style="font-size:1.1rem">Rating : {{$products[$i-1]->rating}}/5 ⭐</div> --}}
        <div class="mb-3" style="font-size:1.1rem">Rp. {{ number_format($products[$i-1]->price,0,",",".") }}</div>
        <div class="my-4"></div>
        <a href="{{url('/product/view/'.$products[$i-1]->product_id)}}" class="position-absolute btn bg-green-primary text-white fw-semibold" style="bottom:1vh;left:1vw;">More Detail</a>
    </div>
</div>
