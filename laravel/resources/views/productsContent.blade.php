@for ($i = 1; $i <= count($products); $i++)
            @if($i == 1)
                <div class="row row-cols-3 d-flex justify-content-center">
                    @include('productsCard')
            @elseif($i%3==0)
                    @include('productsCard')
                </div>
                <div class="row row-cols-3 d-flex justify-content-center">
            @else
                @include('productsCard')
            @endif
        @endfor
        </div>
