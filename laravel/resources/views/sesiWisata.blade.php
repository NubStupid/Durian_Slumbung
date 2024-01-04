<div class="card" style="width: 18rem;">
    <ul class="list-group list-group-flush">
        @for($i = 1; $i <= count($sesi); $i++)
            @if($sesi[$i - 1]['sisa_qty']== 0)
                <li class="list-group-item">Sesi {{$i}}: Not Available</li>
            @else
                <li class="list-group-item">Sesi {{$i}}: Sisa slot {{$sesi[$i - 1]['sisa_qty']}} orang</li>
            @endif
        @endfor
    </ul>
</div>
