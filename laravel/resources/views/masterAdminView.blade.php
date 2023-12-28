<div class="">
    <div class="grid grid-cols-4">
        <div class="detail col-span-2">
            <div class="text-3xl font-semibold my-4">{{$a['username']}}</div>
            Username : <input type="text" class="input input-bordered w-full max-w-xs" value="{{$a['username']}}"/><br>
            Password : <input type="text" class="input input-bordered w-full max-w-xs" value="{{$a['password']}}"/><br>
            <div class="my-2">
                <button class="btn btn-outline btn-success" onclick="updateAdmin('{{$a['username']}}')">
                    Update
                </button>
                <button class="btn btn-outline btn-error" onclick="deleteAdmin('{{$a['username']}}')">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
