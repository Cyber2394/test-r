@extends('CDN')
@extends('navbar')
@extends('layouts.app')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body>
<!-- if validation in the controller fails, show the errors -->
@if ($errors->any())
   <div class="alert alert-danger">
     <ul>
     @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
     @endforeach
     </ul>
   </div>
@endif

<div>

<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        <!-- Add CSRF Token -->
        @csrf
    <div class="form-group">
        <label>Product Name</label>
        <input type="text" class="form-control" name="name" required><br>
        <label>Product Price</label>
        <input type="number" class="form-control" name="price" required><br>
        <label>Product Description</label>
        <input type="text" class="form-control" name="description" required>
    </div>
    <div class="form-group">
        <input type="file" name="file" required>
    </div>
    <button type="submit">Submit</button>
</form>

</div>
</body>
</html>
@foreach($products as $product)
        
    <div class="d-flex justify-content-center">
        <div class="card p-3 bg-black">
            <div class="about-product text-center mt-2"><p class="display-4">{{$product->name}}</p>
                <div>
                    <div class="fw-lighter fst-italic">
                        
                    <img src="{{ URL::asset("storage/product/{$product->file_path}") }}"/>
                        <!-- {{$product->file_path}} -->
                        <!-- 2LI7NJyaZlICjwddTOAd3b1rKHJk99Q0711bVOfo.jpg -->
                        
                    </div>
                </div>
            </div>
            <div class="stats mt-2">
                <div class="d-flex justify-content-between p-price"><span>Price:</span><span>{{$product->price}}</span></div>     
            </div>
            <div class="d-flex justify-content-between total font-weight-bold mt-4"><span>Product ID:</span><span>{{$product->id}}</span></div>
        </div>
    </div>

    <form action= "/products/destroy" method="POST">
        @csrf
        <button class="btn btn-danger" type="submit" value="{{$product->id}}" name="product_id">Destroy</button>
    </form>
@endforeach