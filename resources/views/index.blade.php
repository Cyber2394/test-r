<link href="https://cdn.sdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>All Dunks Test Server</title>
    <!-- ajax/jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">All Dunks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" id="allProductBtn">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" id="mensProductBtn">Mens Products</a></li>
                            <li><a class="dropdown-item" id="womensProductBtn">Womans Products</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('search') }}" method="GET" id="search-form">
                                <div class="input-group mb-3">
                                    <input type="text" name="query" id="search-input" class="form-control" placeholder="Search products...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="search-submit" type="submit">Search</button>
                                    </div>
                                </div>
                                <div>
                                    <span class="rounded" id="search-results"></span>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <style>
                    #search-results {
                        position: absolute;
                        top: 70%;
                        left: 39%;
                        width: 20%;
                        background-color: #fff;
                    }
                </style>


                <script src="{{ asset('js/search.js') }}"></script>
                <a class="btn btn-outline-dark col-1" href="/cart">
                    <i class="bi-cart-fill "></i>

                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart">{{$count}}</span>
                </a>
            </div>
        </div>
        <ul class="navbar-nav ms-auto">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <div id="allProductSection">
        <div id="mensSection">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach($maleProducts as $product)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{ asset('storage/product/' . $product->file_path) }}" alt="Product Image">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Man's {{$product->name}}</h5>
                                        <!-- Product price-->
                                        ${{$product->price}}
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><button id="addToCart" class="btn btn-outline-dark mt-auto" name="{{$product->id}}" onclick="getId(this.name), counter(), checkAuth()">Add to Cart</button></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
        <div id="womansSection">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach($femaleProducts as $product)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="{{ URL::asset("storage/product/{$product->file_path}") }}" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">Woman's {{$product->name}}</h5>
                                        <!-- Product price-->
                                        ${{$product->price}}
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><button id="addToCart" class="btn btn-outline-dark mt-auto" name="{{$product->id}}" onclick="getId(this.name), counter(), checkAuth()">Add to Cart</button></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>

<script>
    $('#womansSection').hide();

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#mensProductBtn').click(function(e) {
            $('#mensSection').show('');
            $('#womansSection').hide('');
        });

        $('#womensProductBtn').click(function(e) {
            $('#womansSection').show('');
            $('#mensSection').hide('');
        });

        $('#allProductBtn').click(function(e) {
            $('#womansSection').show('');
            $('#mensSection').show('');
        });

    });

    function counter() {
        $('#cart').html(function(i, val) {
            return +val + 1
        });
    }

    function getId(id) {
        //var items = $('#productId').val();

        $.ajax({
            data: {
                id: id,
            },
            url: 'addToCart',
            type: "GET",
            success: function(data) {
                console.log(id);
            },
            error: function(data) {
                console.log(data)
            }

        });
    }
    //function for when user clicks on search item that pops up while searching

    function search_submit(name) {
        console.log(name);
        $.ajax({
            url: '/products/search_submit',
            type: 'GET',
            data: { name: name }
        });
    }
    // check if user is sigend in
    function checkAuth() {
        $.ajax({
            type: 'GET',
            url: '/check-auth',
            success: function(data) {},
            error: function(data) {

                window.location.href = 'http://127.0.0.1:8000/login';
            }
        });
    }
</script>