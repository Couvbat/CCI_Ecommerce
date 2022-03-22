@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <section id="order">
        <div class="container">
            <div class="row mt-5 py-1 pb-5">
                <div class="col-lg-8">

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h3 class="text-uppercase text-dark">Adresse</h3>
                            <small class="text-dark font-md">{{ auth()->user()->shipping->city }}
                                {{ auth()->user()->shipping->street_nb }} {{ auth()->user()->shipping->street }}
                                {{ auth()->user()->shipping->additional_info }}</small>
                            <span> <a href="{{ route('shipping.edit') }}">Modifier</a> </span>
                        </li>
                        <li class="list-group-item">
                            <h3 class="text-uppercase text-dark">Methode de paiement</h3>
                            <small class="text-dark font-md">Paypal ou Carte de crédit</small>
                        </li>

                        <li class="list-group-item mt-3">
                            <h3 class="text-uppercase text-dark">Article(s) commandé</h3>
                            <ul class="list-group list-group-flush">
                                @foreach (Cart::content() as $key => $product)
                                    <li class="list-group-item">
                                        <div class="row">

                                            <div class="col-md-1 img-container m-0 p-0">
                                                <a href="/product/{{ $product->id }}/{{ $product->slug }}">
                                                    <img src="{{ $product->options->img }}" class="img-fluid" />
                                                </a>
                                            </div>

                                            <div class="col product-name">
                                                <p class="text-dark font-md">
                                                    {{ $product->name }}
                                                </p>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-dark font-md">
                                                    {{ $product->qty }} x €{{ $product->price }} =
                                                    €{{ $product->qty * $product->price }}
                                                </small>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card mt-2">
                        <div class="card-body">

                            <h3 class="text-uppercase">Résumé de commande</h3>
                            <hr>

                            <!-- Subtotal Price -->
                            <div class="row py-1">
                                <div class="col lg-6">Article(s):</div>
                                <div class="col lg-6">{{ Cart::instance('default')->count() }}</div>
                            </div>

                            <!-- Shipping-->
                            <div class="row py-1">
                                <div class="col lg-6">Livraison:</div>
                                <div class="col lg-6">€ 0.00</div>

                            </div>

                            <!-- Total -->
                            <div class="row py-1">
                                <div class="col lg-6">Tax:</div>
                                <div class="col lg-6">
                                    <span>{{ Cart::tax() }}</span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="row py-1">
                                <div class="col lg-6">Total:</div>
                                <div class="col lg-6">
                                    <span class="fw-bold">€{{ Cart::total() }}</span>
                                    <input type="hidden" id="total" value="{{ $total }}">
                                </div>
                            </div>

                            <hr />

                            {{-- PAYPAL BUTTON --}}
                            <div id="paypal-button-container"></div>

                            <div class="d-flex gap-2 col-lg-7 mx-auto">
                                <img src="img/payment.png" class="img-fluid" />
                            </div>

                        </div>

                    </div>

                    <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
                        @csrf

                        <div class="form-group">
                            <input type="hidden" name="city" id="city" value="{{ auth()->user()->shipping->city }}"
                                readonly required>
                            <input type="hidden" name="street_nb" id="street_nb"
                                value="{{ auth()->user()->shipping->street_nb }}" readonly required>
                            <input type="hidden" name="street" id="street" value="{{ auth()->user()->shipping->street }}"
                                readonly required>
                            <input type="hidden" name="additional_info" id="additional_info"
                                value="{{ auth()->user()->shipping->additional_info }}" readonly required>
                        </div>

                    </form>

                </div>

            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
@section('extra-js')
    {{-- PAYPAL SDK API --}}
    <script src="https://www.paypal.com/sdk/js?client-id={{ $PAYPAL_CLIENT_ID }}&locale=en_PH&currency=PHP">
    </script>

    {{-- PAYPAL INTEGRATION --}}
    <script src="{{ asset('js/paypalapi.js') }}"></script>
@endsection
