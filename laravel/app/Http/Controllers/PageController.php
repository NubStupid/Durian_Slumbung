<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //Products method
    public function loadMainProducts(){
        $products = DB::connection('connect_Customer')->table('products');
        $products = $products->select(["*"]);
        $products = $products->orderby('products.rating','desc');
        $products= $products->take(12);
        $products = $products->get();
        return $products;
    }
    public function loadSearchedProducts(string $str, int $maxPrice, int $minPrice, int $rated, string $category)
    {
        $products = DB::connection('connect_Customer')->table('products');

        $products->where('products.name', 'like', "%{$str}%")
                ->where('products.price', '>=', $minPrice)
                ->where('products.price', '<=', $maxPrice)
                ->where('products.rating', '<=', $rated);

        if ($category !== "") {
            $products->where('products.category_id', '=', $category);
        }

        $products->orderBy('products.rating', 'desc');

        return $products->get();
    }
    public function getMaxPrice(){
        $maxPrice = DB::connection('connect_Customer')->table('products');
        $maxPrice = $maxPrice->max('products.price');
        return $maxPrice;
    }
    public function getAllCategory(){
        $categories = DB::connection('connect_Customer')->table('categories');
        $categories = $categories->select(["*"]);
        $categories = $categories->get();
        return $categories;
    }



    //Products View
    public function loadProductsView(){
        // Get Product
        $products = $this->loadMainProducts();
        // Get max price from products
        $maxPrice = $this->getMaxPrice();
        // Defining the range step
        $step = $maxPrice/10;
        //Get all categories
        $categories = $this->getAllCategory();
        // Get carousel items
        // TBC
        $user = request()->attributes->get('user');
        return view('products',['products'=>$products,'maxPrice'=>$maxPrice,'step'=>$step,'categories'=>$categories,'user'=>$user]);
    }
    public function searchProduct(Request $req){
        try {
            // Process the data (e.g., save to the database)
            $data = $req->all();
            // dd($data);
            $name = $data["like"];
            $maxPrice = $data["maxPrice"];
            $minPrice = $data["minPrice"];
            $rated = $data["rated"];
            $category = $data["category"];
            $default = $data["mode"];
            if($default == "false"){
                if($name == null){
                    $name = "";
                }
                if($category == null){
                    $category = "";
                }
                $data = $this->loadSearchedProducts($name,$maxPrice,$minPrice,$rated,$category);
            }else{
                $data = $this->loadMainProducts();
            }

            $view = view('productsContent',['products'=> $data]);
            return $view;
            // Return a success response
            // return $data;
        } catch (\Exception $e) {
            // Log the exception for debugging

            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    //Detail Product
    public function getSimilarProduct($id,$category_id){
        $get3SimilarProduct = DB::connection('connect_Customer')->table('products');
        $get3SimilarProduct = $get3SimilarProduct->select(["*"]);
        $get3SimilarProduct = $get3SimilarProduct->where('products.product_id',"!=",$id);
        if($category_id!=""){
            $get3SimilarProduct = $get3SimilarProduct->where("products.category_id","=",$category_id);
        }
        $get3SimilarProduct = $get3SimilarProduct->orderby("products.rating","desc");
        $get3SimilarProduct = $get3SimilarProduct->take(3);
        $get3SimilarProduct = $get3SimilarProduct->get();
        if(count($get3SimilarProduct)==0){
            $get3SimilarProduct = $this->getSimilarProduct($id,"");
        }
        return $get3SimilarProduct;

    }
    public function viewProduct(int $id){
        $productViewed = DB::connection('connect_Customer')->table('products');
        $productViewed = $productViewed->select(["*"]);
        $productViewed = $productViewed->where('products.product_id',"=",$id);
        $productViewed = $productViewed->first();
        $get3SimilarProduct = $this->getSimilarProduct($id,$productViewed->category_id);
        $user = request()->attributes->get('user');
        return view('detailProducts',["product"=>$productViewed,"products"=>$get3SimilarProduct,'user'=>$user]);
    }

    // Wisata
    public function loadWisataView(){
        $user = request()->attributes->get('user');
        return view('wisata',['user'=>$user]);
    }

    public function checkout()
    {
        $user = request()->attributes->get('user');

        $checkout = [];
        if(Session::has('checkout'))
            $checkout = Session::get('checkout');
        return view("checkout",['user'=>$user, 'checkout' => $checkout]);
    }
}
