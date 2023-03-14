<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $role = Auth::User()->role;

        if ($role == '1') {
            return view('admin.index');
        }else{
            return view('index',['products' => $products]);
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
