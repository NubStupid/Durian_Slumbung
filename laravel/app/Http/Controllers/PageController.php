<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


use App\Models\Products;
use App\Models\Categories;
use App\Models\Rating;
use App\Models\Comment;

class PageController extends Controller
{
    //Products method
    public function loadMainProducts(){
        // $products = DB::connection('connect_Customer')->table('products');
        $products = Products::select(["*"]);
        $products = $products->select(["*"]);
        $products = $products->orderby('product.rate','desc');
        $products= $products->take(12);
        $products = $products->get();
        return $products;
    }
    public function loadSearchedProducts(string $str, int $maxPrice, int $minPrice, int $rated, string $category)
    {
        // $products = DB::connection('connect_Customer')->table('products');
        $products = Products::select(["*"]);
        $products->where('product.name', 'like', "%{$str}%")
                ->where('product.price', '>=', $minPrice)
                ->where('product.price', '<=', $maxPrice)
                ->where('product.rate', '<=', $rated);

        if ($category !== "") {
            $products->where('product.category_id', '=', $category);
        }

        $products->orderBy('product.rate', 'desc');
        // dd($products);
        return $products->get();
    }
    public function getMaxPrice(){
        // $maxPrice = DB::connection('connect_Customer')->table('products');
        $maxPrice = Products::select(["*"]);
        $maxPrice = $maxPrice->max('product.price');
        return $maxPrice;
    }
    public function getAllCategory(){
        // $categories = DB::connection('connect_Customer')->table('categories');
        // $categories = $categories->select(["*"]);
        $categories = Categories::select(["*"]);
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
        // $get3SimilarProduct = DB::connection('connect_Customer')->table('products');
        // $get3SimilarProduct = $get3SimilarProduct->select(["*"]);
        $get3SimilarProduct = Products::select(["*"]);
        $get3SimilarProduct = $get3SimilarProduct->where('product.product_id',"!=",$id);
        if($category_id!=""){
            $get3SimilarProduct = $get3SimilarProduct->where("product.category_id","=",$category_id);
        }
        $get3SimilarProduct = $get3SimilarProduct->orderby("product.rate","desc");
        $get3SimilarProduct = $get3SimilarProduct->take(3);
        $get3SimilarProduct = $get3SimilarProduct->get();
        if(count($get3SimilarProduct)==0 || count($get3SimilarProduct)<3){
            $get3SimilarProduct = $this->getSimilarProduct($id,"");
        }
        return $get3SimilarProduct;

    }
    public function getRating($id){
        $username = Session::get('username');
        $ratingObj = Rating::where('product_id',$id)->where('username',$username)->first();
        if($ratingObj != null)
            return $ratingObj->rate;
        else
            return 0;

    }
    public function getProductComments($product_id){
        $comments = Comment::select(["*"])->where("product_id",$product_id)->get();
        // dd($comments);
        return $comments;
    }
    public function viewProduct(int $id){

        // $productViewed = DB::connection('connect_Customer')->table('products');
        // $productViewed = $productViewed->select(["*"]);
        // $productViewed = $productViewed->where('products.product_id',"=",$id);
        // $productViewed = $productViewed->first();
        $productViewed = Products::select(["*"])->where('product_id',$id)->first();
        $get3SimilarProduct = $this->getSimilarProduct($id,$productViewed->category_id);
        $user = request()->attributes->get('user');
        $rating = $this->getRating($id);
        $comments = $this->getProductComments($id);
        return view('detailProducts',["product"=>$productViewed,"products"=>$get3SimilarProduct,'user'=>$user,'rating'=>$rating,'comments'=>$comments]);
    }

    // Wisata
    public function loadWisataView(){
        $user = request()->attributes->get('user');
        return view('wisata',['user'=>$user]);
    }

    public function checkout()
    {
        $user = request()->attributes->get('user');

        // $checkout = [];
        // if(Session::has('checkout'))
        //     $checkout = Session::get('checkout');
        $tgl = "01-06-2023";
        $produk[] = [
            "product_id" => "P001",
            "product_name" => "Durian Kecil",
            "product_price" => 10000,
            "qty" => 2,
            "subtotal" => 20000
        ];
        $produk[] = [
            "product_id" => "P002",
            "product_name" => "Durian Sedang",
            "product_price" => 15000,
            "qty" => 1,
            "subtotal" => 15000
        ];
        $totalProduk = [
            "qty" => 2,
            "harga" => 35000
        ];

        $wisata[] = [
            "wisata_id" => "W001",
            "wisata_name" => "Pengolahan Es Krim Durian",
            "date" => "30-11-2023",
            "wisata_price" => 10000,
            "qty" => 2,
            "subtotal" => 20000
        ];
        $wisata[] = [
            "wisata_id" => "W002",
            "wisata_name" => "Pengolahan Pancake Durian",
            "date" => "12-12-2023",
            "wisata_price" => 10000,
            "qty" => 1,
            "subtotal" => 10000
        ];
        $totalWisata = [
            "qty" => 2,
            "harga" => 30000
        ];
        return view("checkout",[
            'user' => $user,
            'tgl' => strtotime($tgl),
            // 'tgl' => date_create($tgl),
            'produk' => $produk,
            'totalProduk' => $totalProduk,
            'wisata' => $wisata,
            'totalWisata' => $totalWisata
        ]);
    }
}
