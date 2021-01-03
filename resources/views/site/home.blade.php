<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Macellan Quiz</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v='.time()) }}" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Macellan Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto pl-4">
            <li class="nav-item  active ">
                <a class="nav-link" href="{{ route('site.home') }}">Anasayfa</a>
            </li>
        </ul>
        <span class="navbar-text"></span>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">

            <div class="categories">
                <ul>
                    @foreach ($categories->whereNull('parent_id') as $category)
                        @include('partials.category', ['child' => $category, 'categories' => $categories])
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col-md-9">
            @if($cat)
                <div class="container mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="category-title">{{ $cat->name }}<span class="total-product"><strong>Toplam ürün: </strong> {{ $products->total() }}</span></h4>
                        </div>
                    </div>
                </div>
            @endisset
            <div class="container">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/placeholder.png') }}" class="card-img-top">
                                <span class="badge badge-success">{{ $product->price }} ₺</span>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            {{ $products->links() }}

        </div>
    </div>
</div>

</body>
</html>
