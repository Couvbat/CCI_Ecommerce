@extends('layouts.app')

@section('title')
    Produits
@endsection

@section('content')

    <!-- Page Content -->
    <!-- Items Starts Here -->
    <div class="featured-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Tout les produits</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured container no-gutter">

        <div class="row posts">
            @foreach ($products as $product)
                <div id="{{ $product->id }}"
                     class="item {{ $product->category }}
                     {{ (\Carbon\Carbon::now()->between($product->created_at, $product->created_at->addDays(2))) ? 'Nouveau' : ''}}
                         col-md-4"
                >
                    <a href="/product/{{ $product->id }}/{{ $product->slug }}">
                        <div class="featured-item">
                            <img src="{{ $product->photos[0]->url }}" width="308" height="233">

                            <h4>
                                @if (strlen($product->name) > 0 && strlen($product->name) < 49)
                                    <br>{{ substr($product->name,0 , 48) }}<br>
                                @elseif(strlen($product->name) > 48) <!-- Trop de texte -->
                                {{ substr($product->name,0 , 45) }}...
                                @endif
                            </h4>

                            <h6>{{ $product->price }}€</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pagination">
        <div class="container justify-content-center">
            <div class="row  justify-content-center">
                <div class="col-12">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Featred Page Ends Here -->

@endsection
