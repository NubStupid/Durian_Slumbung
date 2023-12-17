<div class="">
    <div class="grid grid-cols-4">
        <figure><img src="{{$p['img_url']}}" alt="" style="max-height:auto; max-width:20vw;" class="rounded-lg"></figure>
        <div class="detail col-span-2">
            <div class="text-3xl font-semibold">{{$p['name']}}</div>
            Name : <input type="text" class="input input-bordered w-full max-w-xs" value="{{$p['name']}}"/><br>
            Price : <input type="text" class="input input-bordered w-full max-w-xs" value="{{$p['price']}}"/><br>
            Category : <select class="select select-bordered w-full max-w-xs">
                            @foreach ($category as $c)
                                @if($c["category_id"] !== $p['category_id'])
                                    <option value="{{$c['category_id']}}">{{$c['name']}}</option>
                                @else
                                    <option selected value="{{$p['category_id']}}">{{$c['name']}}</option>
                                @endif
                            @endforeach
                        </select><br>
            QTY : <input type="text" class="input input-bordered w-full max-w-xs" value="{{$p['qty']}}"/><br>
            Image : <input type="file" class="file-input w-full max-w-xs" /><br>
            Description : <br> <textarea class="textarea textarea-bordered textarea-md w-full max-w-xs" placeholder="Bio">{{$p['description']}}</textarea><br>
            <div class="my-2">
                <button class="btn btn-outline btn-success" onclick="updateProduct('{{$p['product_id']}}')">
                    Update
                </button>
                <button class="btn btn-outline btn-error" onclick="deleteProduct('{{$p['product_id']}}')">
                    Delete
                </button>
            </div>
        </div>
    </div>

</div>
