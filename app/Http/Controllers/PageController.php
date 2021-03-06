<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use App\Products;
use App\TypeProduct;
use Auth;

class PageController extends Controller
{
    public function getIndex(Request $request){
    	$ten = $request->name;
    	//return $request->url(); 
    	if($request->isMethod('get')){
    		echo 'đây là route get';
    	}
    	else{
    		echo 'không phải route get';
    	}

    	//return view('welcome',['name'=>$ten, 'message'=>'Gửi thành công']);
    }












    public function getLogin(){
    	return view('login');
    }
    public function postLogin(Request $req){
    	/*$arr = array(
                        'email'=>$req->username,
                        'password'=>$req->password
                    );*/

        if(Auth::check()){
            return view('trang_quan_tri');
        }
        else{
            echo 'sai thông tin';
        }
    }

    function getLogout(){
        Auth::logout();
        echo 'Đã logout';
    }


    // public function getAdmin(){
    //     return view('trang_quan_tri');
    // }

















    public function setCookie(){
    	$res = new Response;
    	$res->withCookie(
    		'hoten',
    		'Huong Huong',
    		2
    	);
    	echo 'đã set cookie';
    	return $res;
    }

    public function getCookie(Request $req){
    	if($req->cookie('hoten')!=''){
    		echo $req->cookie('hoten');
    	}
    	else{
    		echo 'Chưa có cookie';
    	}
    }


    public function setSession(){
    	session()->put('ten','Huong');
    	echo 'đã có session';
    }

    public function getSession(){
    	if(session()->has('ten')){
    		echo session('ten');
    	}
    	else{
    		echo 'Chưa có session';
    	}
    }

    public function getTrangchu(){
        $arr = array('PHP','iOS','NodeJS');
        return view('page/trangchu',compact('arr'));
    }

    public function getChitiet(){
        return view('page.chitiet'); //page/chitiet
    }


    public function getListProduct(){
        //$sanpham = DB::table('products')->get(); //SELECT * FROM prducts
        // $sanpham = DB::table('products')
        //                 ->select('name','unit_price','image')
        //                 ->get();
        // $customer = DB::table('customer')
        //                 ->select('name','gender','address','phone_number')
        //                 ->orderBy('name','ASC')
        //                 ->get();
        /*$sanpham = DB::table('products')
                        ->select('name','description','unit_price','image')
                        ->orderBy('unit_price','DESC')
                        ->get();*/

        /*$sanpham = DB::table('products')
                        ->select('name','description','unit_price','image')
                        ->where([
                            ['name','like','%crepe%'],
                            ['unit_price','>',160000]
                        ])->get();*/
        /*$sanpham = DB::table('products')
                        ->select('name','description','unit_price','image')
                        ->whereBetween('unit_price',[50000,100000])->get();*/
        /*$sanpham = DB::table('products')
                        ->select('name','description','unit_price','image')
                        ->where('name', 'like','%Smoke Chicken Pizza%')
                        ->orWhere('name', 'like','%Bánh Gato Trái cây Việt Quất%')
                        ->orWhere('name','like','%Bánh Táo - Mỹ%')
                        ->get();*/
        /*$sanpham = DB::table('products')
                        ->select('name','description','unit_price','image')
                        ->orderBy('unit_price','DESC')
                        ->offset(10) //vi trí
                        ->limit(10) //soluong
                        ->get();*/
        /*$sanpham = DB::table('products')
                        ->join('type_products','products.id_type','=','type_products.id')
                        ->select('type_products.name as TenLoai','products.name as TenSP')
                        ->get();*/
        /*$loaisp = DB::table('type_products')
                    ->join('products','products.id_type','=','type_products.id')
                    ->select('type_products.name', DB::raw("count('products.id') as soluong"))
                    ->groupBy('type_products.name')
                    ->get();*/
            /*select name, count(products.id) from type_products  
            INNER JOIN products ON products.id_type = type_products.id
            group by type_products.name*/

        /*$loaisp = DB::table('type_products')
                    ->join('products','products.id_type','=','type_products.id')
                    ->select('type_products.name', DB::raw("avg(products.unit_price) as dongiatrungbinh"))
                    ->groupBy('type_products.name')
                    ->get();*/
    
            //sum(products.unit_price)/count(products.id)


        /*$loaisp = DB::table('products')
                    ->join('type_products','products.id_type','=','type_products.id')
                    ->select('type_products.name as TenLoai','products.name as TenSP','unit_price')
                    ->orderBy('unit_price','ASC')
                    ->groupBy('type_products.name','products.name','unit_price')
                    ->first();*/
       /* $loaisp = DB::table('products')
                    ->join('type_products','products.id_type','=','type_products.id')
                    ->select('type_products.name', DB::raw("sum(products.unit_price) as tonggia"), DB::raw("count(products.id) as tongsoluong"))
                    ->whereIn('products.unit_price',[50000,100000])
                    ->groupBy('type_products.name')
                    ->get();*/
        /*$bill = DB::table('bills')
                    ->join('bill_detail','bills.id','=','bill_detail.id_bill')
                    ->select('bills.id','bills.created_at',DB::raw("count(bill_detail.id_product)"),'total')
                    ->groupBy('bills.id','bills.created_at','total')
                    ->get();*/
        $sanpham = DB::table('products')
                        ->join('type_products','products.id_type','=','type_products.id')
                        ->select('type_products.name as TenLoai','products.name as TenSP',DB::raw("avg(unit_price)"))
                        ->where('type_products.name','Bánh ngọt')
                        ->groupBy('type_products.name','products.name')->get();
        dd($sanpham); 
    }


    public function getTestModel(){
        // $sanpham = Products::all();
        // // foreach ($sanpham  as $value) {
        // //     echo $value->name.'<br>';
        // // }

        /*$sanpham = TypeProduct::with('Products')->get();
        foreach ($sanpham as $sp) { //cho arr loại sp
            foreach($sp->Products as $v){ //cho arr sp theo từng loại
                echo "Tên sp: ".$v->name.'<br>';
            }
            
        }
        dd($sanpham); 
        */
        $a = 2;
        $b= 3;
        $dongia = Products::selectRaw("avg(unit_price) as dongiatrunghinh, type_products.name")
                ->join('type_products',function($query) use($a,$b) {
                    $query->on('type_products.id','=','products.id_type');
                    $query->where('type_products.name','=','Bánh ngọt');
                    $query->where('type_products.id','=',$a);
                })
                ->groupBy('type_products.name')
                ->first();
        dd($dongia);


    }
}
