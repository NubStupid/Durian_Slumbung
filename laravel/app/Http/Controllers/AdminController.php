<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Charts\GoodProductChart;
use App\Models\Htrans;
use App\Models\Dtrans;
use App\Models\Wisata;
use App\Models\Categories;
use App\Models\Admin;
use App\Models\BookedWisata;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboard(GoodProductChart $chart){
        $last5Trans = Htrans::orderBy('h_trans_id','desc')->take(5)->get();
        $pinfo = [];
        foreach($last5Trans as $i => $trans){
            // dd($trans->dtrans->products);
            $dt = $trans->dtrans;
            foreach ($dt as $i => $d) {
                if($d->product)
                    $toAdd['product'] = $d->product;
                else
                    $toAdd['product'] = $d->wisata->Olahan;
                $toAdd['qty'] = $d->qty;
                $pinfo[] = $toAdd;
            }
        }
        return view('adminhomepage',['chart'=>$chart->build(),'latestTrans'=>$pinfo]);
    }

    public function productReport(){
        $allTrans = Dtrans::select('product_id',DB::raw("SUM(qty) as total_qty"))->groupBy('product_id')->get();
        $products =[];
        foreach ($allTrans as $i => $dt) {
            $toAdd['product'] = $dt->product;
            $toAdd['qty'] = $dt->total_qty;
            $products[] = $toAdd;
        }
        return view('productreport',['products'=>$products]);
    }

    public function wisataReport(){
        $allBookedWisata = BookedWisata::orderBy('tgl_dipesan','desc')->get();
        foreach($allBookedWisata as $a){
            $allWisata[] = $a->Wisata;
        }
        return view('wisatareport',['wisata'=>$allWisata,'wisataTGL'=>$allBookedWisata]);
    }
    public function filterWisata(Request $req){
        $data = $req->all();
        $filter = $data["time"];
        if($filter == "today"){
            $BookedData = BookedWisata::whereDate('tgl_dipesan',today())->orderBy('tgl_dipesan','desc')->get();
        }else if($filter == "this week"){
            $BookedData = BookedWisata::whereBetween('tgl_dipesan',[now()->subWeek(),now()])->orderBy('tgl_dipesan','desc')->get();
        }else if($filter == "this month"){
            $BookedData= BookedWisata::whereMonth('tgl_dipesan',now()->month)->whereYear('tgl_dipesan',now()->year)->orderBy('tgl_dipesan','desc')->get();
        }else{
            $BookedData= BookedWisata::orderBy('tgl_dipesan','desc')->orderBy('tgl_dipesan','desc')->get();
        }
        $dataW = [];
        foreach($BookedData as $a){
            $dataW[] = $a->Wisata;
        }
        $view = view('wisatareportCard',['wisata'=>$dataW,'wisataTGL'=>$BookedData]);
        return $view;
    }

    public function adminProduct(){
        $allProduct = Products::all();
        $allCategory = Categories::all();
        return view('adminproduct',['products'=>$allProduct,'category'=>$allCategory]);
    }

    public function viewProduct(Request $req){
        $data = $req->all();
        $p_id = $data["p_id"];
        $allCategory = Categories::all();
        $viewed = Products::where('product_id',$p_id)->first();
        $view = view('adminproductView',['p' => $viewed,'category'=>$allCategory]);
        return $view;
    }

    public function searchProduct(Request $req){
        $data = $req->all();
        $filter = $data["name"];
        $filtered = Products::where('name','like','%'.$filter.'%')->get();
        $view = view('adminproductCard',['products'=>$filtered]);
        return $view;
    }

    public function masterAdmin(){
        $allAdmin = Admin::where('role','=','A')->get();
        return view('masterAdmin',['admins'=>$allAdmin]);
    }

    public function searchAdmin(Request $req){
        $data = $req->all();
        $filter = $data["name"];
        $filtered = Admin::where('username','like','%'.$filter.'%')->where('role','=','A')->get();
        $view = view('masterAdminCard',['admins'=>$filtered]);
        return $view;
    }

    public function viewAdmin(Request $req){
        $data = $req->all();
        $a_id = $data["a_id"];
        $viewed = Admin::where('username',$a_id)->where('role','=','A')->first();
        $view = view('masterAdminView',['a' => $viewed]);
        return $view;
    }

    public function addProduct(Request $req){
        $latestProduct = Products::latest('product_id')->first();
        $idadd = 0;
        if($latestProduct == null){
            $newID = "P0001";
        }
        else{
            $idadd = intval(substr($latestProduct->product_id, 1))+1;
        }

        $newID = "P" . str_pad($idadd, 4, '0', STR_PAD_LEFT);

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($req->file("img") as $photo) {
            $namaFilePhoto  = "D".$newID.".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $name = $req->name;
        $price = $req->price;
        $category = $req->category;
        $qty = $req->qty;
        $img = $namaFilePhoto;
        $desc = $req->desc;

        $res = Products::create([
            'product_id' => $newID,
            'name' => $name,
            'price' => $price,
            'category_id' => $category,
            'qty' => $qty,
            'description' => $desc,
            'img_url' => $img,
            'rate' => 0
        ]);

        return redirect()->back()->with('sukses', 'sukses');

    }

    public function addAdmin(Request $req){
        $username = $req->username;
        $password = $req->password;

        $res = Admin::create([
            'username' => $username,
            'password' => $password,
            'role' => 'A'
        ]);

        return redirect()->back()->with('sukses', 'sukses');

    }

    public function updateProduct(Request $req, $id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->name = $req->name;
        $product->price = $req->price;
        $product->category_id = $req->category;
        $product->qty = $req->qty;
        $product->img_url = "DP0011.jpg";
        $product->description = $req->desc;
        $product->save();

        $allProduct = Products::all();
        $allCategory = Categories::all();

        return view('adminproductCard',['products'=>$allProduct,'category'=>$allCategory]);
    }
    public function updateAdmin(Request $req, $user)
    {
        $admin = Admin::find($user);

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->username = $req->username;
        $admin->password = $req->password;
        $admin->save();

        $alladmin = Admin::all();
        return view('masterAdminCard',['admin'=>$alladmin]);
    }

    public function deleteProduct($id){
        $product = Products::find($id);
        $product->delete($id);

        $allProduct = Products::all();
        $allCategory = Categories::all();

        return view('adminproductCard',['products'=>$allProduct,'category'=>$allCategory]);
    }
    public function deleteAdmin($id){
        $admin = Admin::find($id);
        $admin->delete($id);

        $alladmin = Admin::all();

        return view('masterAdminCard',['admin'=>$admin]);
    }
}
