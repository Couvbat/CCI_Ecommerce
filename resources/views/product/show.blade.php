@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/flex-slider.css') }}"/>
@endsection

@section('content')

    <!-- Page Content -->
    <!-- Single Starts Here -->
    <div class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">

                        @if( session('status') )
                            <div class="alert alert-success alert-dismissible mt-3">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('status')  }}
                            </div>
                        @endif

                        @if( session('error') )
                            <div class="alert alert-danger alert-dismissible mt-3">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('error')  }}
                            </div>
                        @endif

                        <div class="line-dec"></div>
                        <h1>{{ $product->name }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                @foreach($product->photos as $photo)
                                    <li>
                                        <img src="../../{{ $photo->url }}" width="468" height="468"/>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @foreach($product->photos as $photo)
                                    <li>
                                        <img src="../../{{ $photo->url }}" width="468" height="468"/>
                                    </li>
                            @endforeach
                            <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-content">

                        <h4>{{ $product->name }}</h4>

                        <h6>{{ $product->price }}€</h6>

                        <p style="overflow-wrap:normal	;">
                            {!! strip_tags($product->description) !!}
                        </p>

                        <span class="{{ ($product->qty < 1) ? 'text-danger' : "" }}">
                            {{ ($product->qty > 0) ? $product->qty. ' en stock' : "Rupture de stock" }}
                        </span>


                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                            @csrf
                            <label for="quantity">Quantité:</label>
                            <input
                                name="product_qty"
                                type="number"
                                min="1"
                                max="{{ $product->qty }}"
                                class="quantity-text @error('product_qty') border border-danger @enderror"
                                value="{{ old('product_qty') ?? 1 }}"
                                id="quantity"
                                onfocus="if(this.value == '1') { this.value = ''; }"
                                onBlur="if(this.value == '') { this.value = '1';}"
                                value="1"
                                required
                                {{ ($product->qty < 1) ? "disabled" : "" }}
                            />

                            @error('product_qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit"
                                    class="btn {{ ($product->qty < 1) ? "btn-danger" : "btn-primary" }}" {{ ($product->qty < 1) ? "disabled" : "" }}>
                                Ajouter au panier
                            </button>
                        </form>

                        <div class="down-content">
                            <div class="share">
                                <h6>
                                    Partager:
                                    <span>
                                        <a href="https://github.com/Couvbat">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    </span>
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Page Ends Here -->

@endsection

@section('extra-js')
    <script src="{{ asset('js/cartqty.js') }}"></script>
@endsection
