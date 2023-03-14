<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
    
        //dd($products);
        return view('products.create',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('products.create',['products' => $products]);
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
            $product = new Product([
                "name" => $request->get('name'),
                "price" => $request->get('price'),
                "description" => $request->get('description'),
                "file_path" => $request->file->hashName()
            ]);
            $product->save(); // Finally, save the record.
        }
        $products = Product::all();

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('products.create',['products' => $products]);
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
            return view('products.destroy',['products' => $products]);
        }
     }

    public function destroy(Request $request)
    {
        $role = Auth::User()->role;
        
        if(isset($_POST['product_id']) && $role == '1'){
            
            $product_id = $_POST['product_id'];
            // echo "this is product id" . $product_id;
            Product::where('id', '=', $product_id)->delete();
            
            $products = Product::all();

                return view('products.destroy',['products' => $products]);
            
        }else{
            $products = Product::all();
            return view('products.create',['products' => $products]);
        }
    }
}
