@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

    <!-- Page Content -->

    <!-- Featured Starts Here -->
    <div class="featured-items">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>En ce moments</h1>
                        <div class="ml-auto">
                            <a href="{{ route('product.view') }}">Voir tout les produits <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">

                    <x-home-product :products="$products"/>

                </div>
            </div>
        </div>
    </div>
    <!-- Featured Ends Here -->

@endsection
