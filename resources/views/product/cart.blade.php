@extends('layouts.app')

@section('title')
    Panier
@endsection

@section('content')


    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg mt-5">
        <div class="container">
            <h2 class="title-page">Panier</h2>


            @if (session('status'))
                <div class="alert alert-success alert-dismissible mt-3 mb-3">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible mt-3 mb-3">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Check If Cart is Empty --}}
            @if (Cart::count() == 0)
                <!-- Cart Info -->
                <div class="alert alert-info" style="margin-bottom: 10rem;" role="alert">
                    Votre panier est vide. <a href="{{ route('home') }}" class="alert-link">Go Back</a>
                </div>

        </div>
    </section>
    <!-- ========================= SECTION INTRO END// ========================= -->
@else
    <!-- Show Only Pending Products -->


    <!--Main layout-->
    <main>
        <div class="container">

            <!--Section: Block Content-->
            <section class="mt-5 mb-4">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-lg-8">

                        <!-- Card -->
                        <div class="card wish-list mb-4">
                            <div class="card-body">

                                <h5 class="mb-4">Panier (<span>{{ Cart::count() }}</span> items)</h5>


                                {{-- START PROdUCT --}}
                                @foreach (Cart::content() as $key => $product)
                                    <div class="row mb-4">
                                        <div class="col-md-5 col-lg-3 col-xl-3">
                                            <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                                <a
                                                    href="{{ route('product.show', ['product' => $product->id, 'slug' => $product->options->slug]) }}">
                                                    <img class="img-fluid w-100" src="{{ $product->options->img }}"
                                                        alt="Sample">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-9 col-xl-9">
                                            <div>

                                                <div class="d-flex justify-content-between">

                                                    <div>
                                                        @if (strlen($product->name) > 25)
                                                            <h5 class="prd-name">{{ substr($product->name, 0, 25) }}
                                                                ...</h5>
                                                        @else
                                                            <h5 class="prd-name">{{ $product->name }}</h5>
                                                        @endif
                                                    </div>

                                                    <div class="quantity-section">

                                                        <div class="def-number-input number-input safari_only mb-0 w-100">
                                                            <button
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                                class="minus"
                                                                id="minus_{{ $product->rowId }}"></button>

                                                            <form action="/cart" method="POST">
                                                                @csrf

                                                                <input data-id="{{ $product->rowId }}"
                                                                    class="product_qty quantity @error('product_qty') border border-danger @enderror"
                                                                    type="number" name="product_qty"
                                                                    id="product_qty_{{ $product->rowId }}" min="1"
                                                                    max="{{ $product->options->stock }}"
                                                                    value="{{ $product->qty }}" readonly />

                                                            </form>

                                                            <button
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                                class="plus"
                                                                id="plus_{{ $product->rowId }}"></button>
                                                        </div>

                                                        {{-- <small id="passwordHelpBlock" class="form-text text-muted text-center">
                                                          (Note, 1 piece)
                                                        </small> --}}

                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <form action="{{ route('cart.destroy', $product->rowId) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="gray remove-item card-link-secondary small text-uppercase mr-3">
                                                                <i class="fa fa-trash gray mr-1"></i> Retirer </a>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <p class="mb-0 text-black lead">
                                                        <span><strong>{{ $product->price }}&#8364</strong></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4">
                                @endforeach
                                {{-- END PRODUCT --}}

                                <p class="text-primary mb-0"><i class="fa fa-info-circle mr-1"></i> Nous n'acceptons pour
                                    l'instant uniquement les paiments par PayPal et par carte de crédit.</p>

                                <a href="{{ route('product.view') }}" class="btn btn-light mt-3 float-md-right">
                                    <i class="fa fa-chevron-left"></i> Continuer vos achats

                            </div>
                        </div>
                    </div>

                    <!--Grid column-->
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Sous-total:</dt>
                                    <dd id="subtotal" class="text-right">{{ Cart::subtotal() }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>TVA:</dt>
                                    <dd id="tax" class="text-right">{{ Cart::tax() }}</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd id="total" class="text-right h5"><strong>€{{ Cart::total() }}</strong></dd>
                                </dl>
                                <hr />
                                <p class="text-center mb-3">
                                    <img src="img/payment.png" height="26" />
                                </p>
                                <p class="text-center mx-auto">
                                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                                        Confirmer l'achat <i class="fa fa-chevron-right"></i>
                                    </a>
                                </p>

                            </div>
                            <!-- card-body.// -->
                        </div>
                        <!-- Card -->


                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </section>
            <!--Section: Block Content-->

        </div>
    </main>
    <!--Main layout-->
    @endif


    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/cartqty.js') }}"></script>
@endsection
