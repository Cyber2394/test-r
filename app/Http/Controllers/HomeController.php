<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $male_products = Product::where('is_male','=', 1)->get();
        $female_products = Product::where('is_female','=', 1)->get();

        $user_id =  Auth::id();

        $cart = Cart::where('user_id', '=', $user_id)->get('product_id');
        //return $cart;
        preg_match_all('!\d+!', $cart, $matches);
        
        //print("<pre>".print_r($matches,true)."</pre>");
        foreach($matches as $match){
            $count =Cart::where('user_id','=', $user_id)
                ->update([
                'count'=> DB::raw('count+1'), 
            ]);
        }

        $role = Auth::User()->role;
        if ($role == '1') {
            return view('admin.index');
        }else{
           
            return view('index',['count'=> $count, 'maleProducts' => $male_products, 'femaleProducts' => $female_products]);
        }
    }

    public function view_products()
    {
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('admin.view_products',['products' => $products]);
        }else{
            return view('index',['products' => $products]);
        }
    }
}
