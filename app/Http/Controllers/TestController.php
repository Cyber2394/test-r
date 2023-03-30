<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();

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

        return view('test',['count'=> $count, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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
            /**
         * eli's solution where he joins the tables somehow
         */
        $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=' , 'products.id')
        ->where('cart.user_id',$user_id)
        ->select('products.*', 'cart.id', 'cart.id as cart_id')
        ->get();
        
        $id = Cart::get();

        $price = DB::table('cart')
        ->join('products', 'cart.product_id', '=' , 'products.id')
        ->where('cart.user_id',$user_id)
        ->select('products.price')
        ->get();

        //return $price;
        preg_match_all('!\d+!', $price, $array);

        foreach($array as $arrays){
            $sum = array_sum($arrays);
            
        }

        return response()->json(['carts' => $products, 'count'=> $count, 'ids'=> $id, 'prices'=> $sum]);      
    }

    function addToCart(Request $request)
    {
        
        if(isset($_GET["productId"]) )
        {
            $user_id =  Auth::id();

            $product_id= $_GET["productId"];

            //$cart = Cart::all();

            Cart::create([
                'user_id' =>$user_id,
                'product_id' => $product_id,
            ]);

            $products = Product::all();

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

            return view('test',['count'=> $count, 'products' => $products]);
        }
        else
        {
            $product_id= $_GET["productId"];
            echo $product_id;
            //return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cart(Request $request)
    {
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
            /**
         * eli's solution where he joins the tables somehow
         */
        $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=' , 'products.id')
        ->where('cart.user_id',$user_id)
        ->select('products.*', 'cart.id as cart_id')
        ->get();
        
        $id = Cart::get('id');

        return view('cart',['carts' => $products, 'count'=> $count, 'ids'=> $id]);
    }

    /**
     * Display the specified resource.
     */


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // $request->item;
        // echo $request;
        // //return $request;
        // if(isset($request->item)){
        //     $id = $request->item;
        //     Cart::where('id', '=', $id)->delete();
        //     return redirect('/cart');
        // }
        

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            Cart::where('id', '=', $id)->delete();
            return redirect('/cart');
        }
        else{
            return redirect('/home');
        }
    }
}
