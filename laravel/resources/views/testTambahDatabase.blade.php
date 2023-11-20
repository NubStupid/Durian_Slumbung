<form action="" method="post">
@csrf

Product_id : <input type="text" name="product_id" id="">
Name : <input type="text" name="name" id="">
Price : <input type="number" name="price" id="">
Category : <select name="category_id" id="">
    @foreach ($categories as  $category)
        <option value="{{$category->category_id}}">{{$category->name}}</option>
    @endforeach
</select>
<button type="submit">Submit</button>


</form>
