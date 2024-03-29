<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $male_products = Product::where('is_male', '=', 1)->get();
        $female_products = Product::where('is_female', '=', 1)->get();
        //dd($male_products);
        $user_id =  Auth::id();

        $cart = Cart::where('user_id', '=', $user_id)->get('product_id');
        //return $cart;
        preg_match_all('!\d+!', $cart, $matches);

        //print("<pre>".print_r($matches,true)."</pre>");
        foreach ($matches as $match) {
            $count = Cart::where('user_id', '=', $user_id)
                ->update([
                    'count' => DB::raw('count+1'),
                ]);
        }

        return view('index', ['count' => $count, 'maleProducts' => $male_products, 'femaleProducts' => $female_products]);
    }


    function addToCart(Request $request)
    {

        if (isset($_GET["productId"])) {
            $user_id =  Auth::id();

            $product_id = $_GET["productId"];



            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);

            $products = Product::all();

            $user_id =  Auth::id();

            $cart = Cart::where('user_id', '=', $user_id)->get('product_id');

            preg_match_all('!\d+!', $cart, $matches);


            foreach ($matches as $match) {
                $count = Cart::where('user_id', '=', $user_id)
                    ->update([
                        'count' => DB::raw('count+1'),
                    ]);
            }
            return redirect('/home');
        } else {
            $product_id = $_GET["productId"];
            echo $product_id;
        }
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%$query%")->get();

        return response()->json($products);
    }

    public function searchResult(Request $request)
    {   

        $query = $request->input('query');
        //return $query;

        if ($query == '') {
            return redirect('/');
        } else {

            $products = Product::where('name', 'LIKE', "%$query%")->get();
            // $male_products = Product::where('is_male', '=', 1)->get();
            // $female_products = Product::where('is_female', '=', 1)->get();
            //dd($male_products);
            $user_id =  Auth::id();

            $cart = Cart::where('user_id', '=', $user_id)->get('product_id');
            //return $cart;
            preg_match_all('!\d+!', $cart, $matches);

            //print("<pre>".print_r($matches,true)."</pre>");
            foreach ($matches as $match) {
                $count = Cart::where('user_id', '=', $user_id)
                    ->update([
                        'count' => DB::raw('count+1'),
                    ]);
            }

            return view('index_search', ['count' => $count, 'Products' => $products]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('products.create', ['products' => $products]);
        }


        //return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required',
        ]);

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->file->store('product', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            // $product = new Product([
            //     "name" => $request->get('name'),
            //     "price" => $request->get('price'),
            //     "description" => $request->get('description'),
            //     "file_path" => $request->file->hashName()
            // ]);
            // $product->save(); // Finally, save the record.
            // if($request->male == true){
            //     return "its male";
            // }elseif($request->female == true){
            //     return "its female";
            // }else{
            //     return "its not working";
            // }

            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->file_path = $request->file->hashName();
            $product->is_male = $request->male == true ? true : false;
            $product->is_female = $request->female == true ? true : false;
            $product->save();
        }
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('products.create', ['products' => $products]);
        }
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

    public function destroy_page()
    {
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('products.destroy', ['products' => $products]);
        }
    }

    public function destroy(Request $request)
    {
        $role = Auth::User()->role;

        if (isset($_POST['product_id']) && $role == '1') {

            $product_id = $_POST['product_id'];
            // echo "this is product id" . $product_id;
            Product::where('id', '=', $product_id)->delete();

            $products = Product::all();

            return view('products.destroy', ['products' => $products]);
        } else {
            $products = Product::all();
            return view('products.create', ['products' => $products]);
        }
    }
}
