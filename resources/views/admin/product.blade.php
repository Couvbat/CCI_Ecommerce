@extends('admin.layouts.app')

@section('title')
    Produits
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Liste des produits</h1>

            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
               data-target="#createProductModal" href="#createProductModal">
                <i class="fas fa-plus font-sm fa-sm text-white-50"></i>
                Ajouter un produit
            </a>
        </div>

        @if( session('status') )
            <div class="alert alert-success alert-dismissible my-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status')  }}
            </div>
    @endif

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="dataTable"
                        width="100%"
                        cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Stocks</th>
                            <th>Prix</th>
                            <th>Categorie</th>
                            <th>Description</th>
                            <th style="min-width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <img src="{{ $product->photos[0]->url }}" class="img-fluid" width="50" height="50"
                                         alt="product-img">
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->qty }}
                                </td>
                                <td>
																		€{{ $product->price }}
                                </td>
                                <td>
                                    {{ $product->category }}
                                </td>
                                <td>
                                    {!! \Illuminate\Support\Str::limit($product->description, 39) !!}
                                </td>
                                <td>

                                    <a class="btn btn-sm btn-light text-uppercase p-2 mt-1" id="editProductModalBtn"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editProductModal" href="#editProductModal" data-id="{{ $product->id }}">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger text-uppercase p-2 mt-1" type="submit">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->

    @include('admin.modals.products.create')
    @include('admin.modals.products.edit')

@endsection
@section('extra-js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/products/createProduct.js') }}"></script>
    <script src="{{ asset('js/products/editProduct.js') }}"></script>
@endsection

