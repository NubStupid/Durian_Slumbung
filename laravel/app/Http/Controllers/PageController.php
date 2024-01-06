<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Users;
use App\Models\Likes;
use App\Models\Olahan;
use App\Models\BookedWisata;
use App\Models\Wisata;
use App\Models\Htrans;

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
    public function getUserLikedComment($user,$comments){
        foreach ($comments as $i => $comment) {
            $isLiked =  Likes::where('comment_id', $comment["comment_id"])->where('username',$user)->get();
            if(count($isLiked)==0){
                $comments[$i]["img_like"] = "assets/detail/like.png";
            }else{
                $comments[$i]["img_like"] = "assets/detail/liked.png";
            }
            $totalLiked = Likes::where('comment_id',$comment["comment_id"])->get()->count();
            $comments[$i]["likes"] = $totalLiked;
        }

        return $comments;
    }

    public function viewProduct($id){

        // $productViewed = DB::connection('connect_Customer')->table('products');
        // $productViewed = $productViewed->select(["*"]);
        // $productViewed = $productViewed->where('products.product_id',"=",$id);
        // $productViewed = $productViewed->first();
        $productViewed = Products::select(["*"])->where('product_id',$id)->first();
        $get3SimilarProduct = $this->getSimilarProduct($id,$productViewed->category_id);
        $user = request()->attributes->get('user');
        $rating = $this->getRating($id);
        $comments = $this->getProductComments($id);
        $comments = $this->getUserLikedComment($user,$comments);
        return view('detailProducts',[
            "product"=>$productViewed,
            "products"=>$get3SimilarProduct,
            'user'=>$user,
            'rating'=>$rating,
            'comments'=>$comments
        ]);
    }

    public function viewCart(){
        $cekuser = Session('username');
        $listcart = Cart::where('username', $cekuser)->get();
        $user = request()->attributes->get('user');
        $listproduct = Products::all();
        $listwisata = Wisata::all();
        $listolahan = Olahan::all();
        return view('cart',[
            "listcart"=>$listcart,
            "listproduct" => $listproduct,
            "user" => $user,
            "listwisata" => $listwisata,
            "listolahan" => $listolahan
        ]);
    }

    public function addCart(string $id, Request $req){
        $qty = $req->input('qty');
        $produk = Products::select(["*"])->where('product_id',$id)->first();
        $cekuser = Session('username');
        $cekisicart = Cart::where('product_id', $id)
            ->where('username', $cekuser)
            ->first();
        if($cekisicart){
            $cekqty = $cekisicart->qty;
            if($cekqty+$qty > $produk->qty){
                return redirect()->back()->with('error', 'gagal');
            }
            else{
                Cart::where('product_id', $id)
                    ->where('username', $cekuser)
                    ->update(['qty' => $cekqty+$qty]);
                return redirect()->back()->with('success', 'sukses');
            }
        }
        else{
            $latestCart = Cart::latest('cart_id')->first();
            $idadd = intval(substr($latestCart->cart_id, 1))+1;
            $newID = "C" . str_pad($idadd, 4, '0', STR_PAD_LEFT);
            $res = Cart::create(
                [
                    "cart_id"=>$newID,
                    "product_id"=>$id,
                    "price"=>$produk->price,
                    "qty"=>$qty,
                    "username"=>$cekuser
                ]
            );
            return redirect()->back()->with('success', 'Quantity updated in the cart.');
        }
        return redirect("detailProducts");
    }
    public function updateQty(Request $req) {
        $qty = $req->input('tempQty');
        $id = $req->input('cekid');
        if($qty==0){
            return back()->with('error', 'Quantity tidak boleh 0!');
        }
        else{
            Cart::where('cart_id', $id)
                        ->update(['qty' => $qty]);

            return back()->with('successupdate', 'Password berhasil diperbarui!');
        }
    }
    public function deleteCartItem($id) {
        $user = Cart::where('cart_id', $id)->first();
        if ($user) {
            $listcart = Cart::where('username', $user->username)->get();
            Cart::where('cart_id', $id)->delete();
            if(count($listcart)==0){
                return response()->json(['message' => 'cart kosong']);
            }
            else{
                return response()->json(['message' => 'Item deleted successfully']);
            }
        }
    }

    public function viewHistory(){
        $cekuser = Session('username');
        $listhistory = Htrans::where('username', $cekuser)->orderby("created_at","desc")->get();
        $user = request()->attributes->get('user');
        // $listproduct = Products::all();
        return view('history',[
            "listhistory"=>$listhistory,
            "user" => $user
        ]);
    }

    // Wisata
    public function loadWisataView(){
        $user = request()->attributes->get('user');

        $olahan = Olahan::all();

        date_default_timezone_set('Asia/Jakarta');

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $day = date('D', strtotime(date('Y-m-01')));

        $lastDay = strtotime("Last day of " . date("M") . " " . date("Y"));
        $lastDay = date("d", $lastDay);
        $prevMonth = strtotime("Last day of " . date("M") . " " . date("Y") . " previous month");
        $prevMonth = date("d", $prevMonth);
        $ctr = array_search($day, $days);

        if($user != ""){
            return redirect('/wisata/wisata');
        }
        else{
            return view('wisata',[
                'user' => $user,
                'olahan' => $olahan,
                'ctr' => $ctr,
                'thn' => date("Y"),
                'bln' => $bulan[date("m")-1],
                'lastDay' => $lastDay,
                'prevMonth' => $prevMonth,
                'selisih' => 0
            ]);
        }
    }

    public function loadWisataViewLogin(){
        $user = request()->attributes->get('user');
        date_default_timezone_set('Asia/Jakarta');

        $olahan = Olahan::all();
        $wisata = Wisata::all();

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $day = date('D', strtotime(date('Y-m-01')));

        $lastDay = strtotime("Last day of " . date("M") . " " . date("Y"));
        $lastDay = date("d", $lastDay);
        $prevMonth = strtotime("Last day of " . date("M") . " " . date("Y") . " previous month");
        $prevMonth = date("d", $prevMonth);
        $ctr = array_search($day, $days);
        return view('wisata',[
            'user' => $user,
            'olahan' => $olahan,
            'wisata' => $wisata,
            'ctr' => $ctr,
            'thn' => date("Y"),
            'bln' => $bulan[date("m")-1],
            'lastDay' => $lastDay,
            'prevMonth' => $prevMonth,
            'selisih' => 0
        ]);
    }

    public function loadWisataViewLoggedIn(Request $req){
        $user = request()->attributes->get('user');
        date_default_timezone_set('Asia/Jakarta');

        $olahan = Olahan::all();

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $day = date('D', strtotime(date('Y-m-01')));

        $lastDay = strtotime("Last day of " . date("M") . " " . date("Y"));
        $lastDay = date("d", $lastDay);
        $prevMonth = strtotime("Last day of " . date("M") . " " . date("Y") . " previous month");
        $prevMonth = date("d", $prevMonth);
        $ctr = array_search($day, $days);
        // ------------------------------------------------------------------------
        $cekuser = Session('username');
        $qty = $req->orang;
        $price = 20000;
        $latestCart = Cart::latest('cart_id')->first();
        $idadd = intval(substr($latestCart->cart_id, 1))+1;
        $newID = "C" . str_pad($idadd, 4, '0', STR_PAD_LEFT);

        $cekID = Wisata::where('hari', $req->hari)
        ->where('sesi', $req->sesi)
        ->first();

        $wisataID = $cekID->wisata_id;

        $cekAvail = Wisata::where('wisata_id', $wisataID)->first();
        $stok = $cekAvail->qty;

        if($stok >= $qty){
            $res = Cart::create(
                [
                    "cart_id"=>$newID,
                    "product_id"=>$wisataID,
                    "price"=>$price,
                    "qty"=>$qty,
                    "tgl_pesan"=>$req->jadwal,
                    "username"=>$cekuser
                ]
            );
            return redirect()->back()->with('showPopup', 'sukses');
        }
        else{
            return redirect()->back()->with('gagal', 'habis');
        }
    }

    public function loadKalender(Request $req){
        try {
            $data = $req->all();

            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
            $day = date('D', strtotime("{$data['thn']}-{$data['bln']}-01"));
            $lastDay = strtotime("Last day of {$month[$data['bln']-1]} {$data['thn']}");
            $lastDay = date("d", $lastDay);
            $prevMonth = strtotime("Last day of {$month[$data['bln']-1]} {$data['thn']} previous month");
            $prevMonth = date("d", $prevMonth);
            $ctr = array_search($day, $days);

            // $date1=date_create("2013-03");
            // $date2=date_create("2013-11");
            // $diff=date_diff($date1,$date2);
            // dump($diff);

            return view('kalender',[
                'ctr' => $ctr,
                'thn' => $data['thn'],
                'bln' => $bulan[$data['bln']-1],
                'lastDay' => $lastDay,
                'prevMonth' => $prevMonth,
                'selisih' => $data['selisih']
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging

            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function loadSesi(Request $req){
        try {
            $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $day = array_search(date('D', strtotime("{$req->tgl}")), $days) + 1;
            $wisata = Wisata::where('hari', $day)->get();
            $sesi = [];
            foreach($wisata as $w)
            {
                $qty = $w->qty;
                $pesan = BookedWisata::where('tgl_dipesan', $req->tgl)->where('wisata_id', $w->wisata_id)->first();
                if($pesan != null)
                    $qty -= $pesan->qty;
                $s = [
                    "wisata_id" => $w->wisata_id,
                    "olahan" => Olahan::find($w->olahan_id)->name,
                    "sisa_qty" => $qty,
                ];
                $sesi[] = $s;
                // dump($s);
                // dump($w);
            }
            // $sesi = BookedWisata::where('tgl_dipesan', $req->tgl)->get();
            // foreach($sesi as $s)
            // {
            //     // dump($s);
            //     dump($s->Wisata);
            // }
            // $data = $req->all();

            // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            // $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            // $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
            // $day = date('D', strtotime("{$data['thn']}-{$data['bln']}-01"));
            // $lastDay = strtotime("Last day of {$month[$data['bln']-1]} {$data['thn']}");
            // $lastDay = date("d", $lastDay);
            // $prevMonth = strtotime("Last day of {$month[$data['bln']-1]} {$data['thn']} previous month");
            // $prevMonth = date("d", $prevMonth);

            // return view('kalender',[
            //     'day' => $day,
            //     'days' => $days,
            //     'thn' => $data['thn'],
            //     'bln' => $bulan[$data['bln']-1],
            //     'lastDay' => $lastDay,
            //     'prevMonth' => $prevMonth
            // ]);
            // dd($day);
            // dd($sesi);
            // dd($sesi->Wisata);
            // dd($sesi->Wisata());
            return view('sesiWisata', [
                'tgl' => $req->tgl,
                'sesi' => $sesi
            ]);
            return $req->tgl;
            return "masuk show sesi";
        } catch (\Exception $e) {
            // Log the exception for debugging

            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // About
    public function loadAboutView(){
        $user = request()->attributes->get('user');
        return view('aboutpage',['user'=>$user]);
    }

    // Profile
    public function loadProfileView(){
        $cekuser = Session('username');
        $userdata = Users::where('username',$cekuser)->first();
        $param['user'] = $userdata;
        return view('profilepage',$param);
    }

    public function updateUsername(Request $req) {
        $user = Auth::user()->username;
        $tempuser = $req->input('tempuser');

        $cekuser = Users::where('username', $tempuser)->first();

        if ($cekuser) {
            return back()->with('error', 'Username sudah ada!');
        }

        $cekuser = Users::where('username', $user)->first();

        if($cekuser->password !== $req->input('passuser')){
            return back()->with('error', 'Password Salah!');
        }

        $cekuser->username = $tempuser;
        $cekuser->save();

        $cekuser = Users::where('username', $tempuser)->first();
        Auth::login($cekuser);

        return back()->with('successemail', 'Username berhasil diperbarui!');
    }

    public function updateNoTelp(Request $req) {
        $user = Auth::user()->username;
        $temptelp = $req->input('temptelp');
        $cektelp = Users::where('telp', $temptelp)->first();

        if ($cektelp) {
            return back()->with('error', 'Nomor telepon sudah ada!');
        }

        if (empty($temptelp) || !is_numeric($temptelp) || strlen($temptelp) !== 11) {
            return back()->with('error', 'Nomor telepon tidak valid. Harus berupa angka dan terdiri dari 11 digit.');
        }

        $cekUser = Users::where('username', $user)->first();

        if (!$cekUser || $cekUser->password !== $req->input('passtelp')) {
            return back()->with('error', 'Password salah. Tidak dapat mengubah nomor telepon.');
        }

        $cekUser->telp =  $temptelp;
        $cekUser->save();

        return back()->with('successtelp', 'Nomor telepon berhasil diperbarui!');
    }
    public function updatePassword(Request $req) {
        $user = Auth::user()->username;
        $newPassword = $req->input('passbaru');
        $confirmPassword = $req->input('passconfirm');

        if ($newPassword !== $confirmPassword) {
            return back()->with('error', 'Password harus sama.');
        }

        $cekUser = Users::where('username', $user)->first();

        if (!$cekUser || $cekUser->password !== $req->input('passlama')) {
            return back()->with('error', 'Password salah. Tidak dapat mengubah nomor telepon.');
        }

        $cekUser->password = $newPassword;
        $cekUser->save();

        return back()->with('successpassword', 'Password berhasil diperbarui!');
    }
    // public function updateGambar(Request $req){
    //     $cekgambar = request()->validate([
    //         'tempgambar' => 'image|max:2048',
    //     ],[
    //         'tempgambar.image' => 'File harus berupa gambar.',
    //         'tempgambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
    //     ]);

    //     $gambarPath = request()->file('tempgambar')->store('profile','public');

    //     if ($gambarPath) {
    //         $cekUser = Users::where('username', Auth::user()->username)->first();
    //         Storage::disk('public')->delete($cekUser->img_url);
    //         $cekUser->img_url = "storage/".$gambarPath;
    //         $cekUser->save();

    //         return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
    //     } else {
    //         return redirect()->back()->with('error', 'Gagal menyimpan gambar.');
    //     }
    // }
    public function updateGambar(Request $request)
    {
        $validatedData = $request->validate([
            'image_base64' => 'required',
        ], [
            'image_base64.required' => 'Masukkan File Gambar!',
        ]);

        $imageBase64 = $request->image_base64;
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64) = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);

        $imageName = time() . '.png';
        $gambarPath = 'profile/' . $imageName;

        $cekUser = Users::where('username', Auth::user()->username)->first();
        $hapus = $cekUser->img_url;

        if (Storage::disk('public')->put($gambarPath, $imageBase64)) {

            if ($hapus) {
                Storage::disk('public')->delete($hapus);
            }

            $cekUser->img_url = "storage/" . $gambarPath;
            $cekUser->save();

            return redirect()->back()->with('successgambar', 'Gambar berhasil diunggah!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan gambar.');
        }
    }

}
