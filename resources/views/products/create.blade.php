@extends('CSS.create_css')
@extends('layouts.app')
@extends('navbar')
@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
   	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section id="contact">

    <div class="section-content">
            <span class="content-header wow fadeIn"> Create New Product</span>
        <h3>This is just temporary</h3>
    </div>
    <div class="contact-section">
    <div class="container">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            <!-- Add CSRF Token -->
            @csrf
            <div class="col-md-6 form-line">
                <div class="form-group">
                    <label for="exampleInputUsername">name</label>
                    <input type="text" class="form-control" name="name" placeholder=" Enter Name*" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Price</label>
                    <input type="number" class="form-control" name="price" placeholder=" Enter Price*" required>
                </div>	

                <div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                            <input type="file" class="form-control d-none" id="customFile1" name="file" required/>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for ="description"> Description</label>
                    <textarea  class="form-control" name="description" placeholder="Enter The description" required></textarea>
                </div>
                <div>

                    <button type="sumbit" class="btn btn-default submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Create</button>
                </div>
                
            </div>
        </form>
    </div>
</section>
@endsection

