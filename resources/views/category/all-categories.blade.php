@extends('layouts.app')

@section('title')
    Categories
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
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured container no-gutter">

        <div class="row posts">
            @foreach ($categories as $category)
                <div id="{{ $category->id }}"
                     class="item {{ $category->name }} col-md-6"
                >
                    <a href="/category/{{ $category->id }}/{{ $category->slug }}">
                        <div class="featured-item">
                            <img src="{{ $category->photos[0]->url }}" width="462" height="350">

                            <h4>
                                @if (strlen($category->name) > 0 && strlen($category->name) < 49)
                                    <br>{{ substr($category->name,0 , 48) }}<br>
                                @elseif(strlen($category->name) > 48) <!-- Trop de texte -->
                                {{ substr($category->name,0 , 45) }}...
                                @endif
                            </h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Featred Page Ends Here -->

@endsection
