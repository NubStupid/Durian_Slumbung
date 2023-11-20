<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function getCustomer(){
        // RAW SQL
        $id =1;
        $customer = DB::connection('connect_Customer')->select('select * from customers');
        $customerWhere = DB::connection('connect_Customer')->select('select * from customers where customer_id=:id',['id'=>$id]);
        // METHOD
        $products = DB::connection('connect_Customer')->table('products');
        $products = $products->select(['products.product_id','products.name', 'products.price', 'categories.name AS category_name']);
        $products = $products->where('products.price', '<=', 100);
        $products = $products->where('products.name', 'like', '%l%');
        $products = $products->orderBy('products.price', 'desc');
        $products = $products->join('categories', 'products.category_id', '=', 'categories.category_id');

        $allProducts = DB::connection('connect_Customer')->table('products');
        $allProducts = $allProducts->select(["*"]);
        //Fetch
        $products = $products->get();
        $allProducts = $allProducts->get();


        $param["customers"] = $customer;
        $param["budi"] = $customerWhere;
        $param["products"] = $products;
        $param["allProducts"] = $allProducts;
        return view('testDatabase',$param);
    }
    public function loadFormTambah(){
        $daftarCategory = DB::connection('connect_Customer')->table('categories');
        $daftarCategory = $daftarCategory->select(["*"]);
        $daftarCategory = $daftarCategory->get();
        $param["categories"] = $daftarCategory;
        return view('testTambahDatabase',$param);
    }
    public function tambah(Request $req){
        $res = DB::connection('connect_Customer')->table('products');
        $res = $res->insert([
            'product_id' => $req->product_id,
            'name' => $req->name,
            'price' => $req->price,
            'category_id' => $req->category_id
        ]);
        if($res){
            return redirect("/testTambah")->with('pesan',"insert berhasil");
        }else{
            return redirect("/testTambah")->with('pesan',"insert gagal");
        }
    }
    public function loadFormUbah(int $id){
        $getProduct = DB::connection('connect_Customer')->table('products');
        $getProduct = $getProduct->where('product_id','=',$id);
        $getProduct = $getProduct->first();

        $daftarCategory = DB::connection('connect_Customer')->table('categories');
        $daftarCategory = $daftarCategory->select(["*"]);
        $daftarCategory = $daftarCategory->get();

        $param["product"] = $getProduct;
        $param["categories"] = $daftarCategory;

        return view('testUbahDatabase',$param);
    }
    public function ubah(Request $req,int $id){
        $res = DB::connection('connect_Customer')->table('products');
        $res = $res->where('product_id',"=",$id);
        $res = $res->update([
            'name' => $req->name,
            'price' => $req->price,
            'category_id' => $req->category_id
        ]);
        if($res){
            return redirect("/testDatabase")->with('pesan',"update berhasil");
        }else{
            return redirect("/testDatabase")->with('pesan',"update gagal");
        }
    }
}
