<form action="" method="post">
    @csrf

    Product_id : <input type="text" name="product_id" id="" value="{{$product->product_id}}" disabled>
    Name : <input type="text" name="name" id="" value="{{$product->name}}">
    Price : <input type="number" name="price" id="" value="{{$product->price}}">
    Category : <select name="category_id" id="">
        @foreach ($categories as  $category)
            <option value="{{$category->category_id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="submit">Submit</button>


    </form>
