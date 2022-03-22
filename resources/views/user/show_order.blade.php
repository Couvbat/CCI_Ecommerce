@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <section id="order">
        <div class="container">
            <div class="row mt-5 pb-5">
                <div class="col-lg-8">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <h3 class="text-uppercase text-dark">Commande #</h3>
                            <small class="text-dark font-md">#{{ $id }}</small>
                        </li>

                        <li class="list-group-item">
                            <h3 class="text-uppercase text-dark">Adresse</h3>
                            <small class="text-dark font-md">{{ auth()->user()->shipping->city }}
															{{ auth()->user()->shipping->street_nb }} {{ auth()->user()->shipping->street }}
															{{ auth()->user()->shipping->additional_info }}</small>
                        </li>

                        <li class="list-group-item">
                            <h3 class="text-uppercase text-dark">Methodes de paiement</h3>
                            <small class="text-dark font-md">Paypal ou carte de crédit</small>
                        </li>

                        <li class="list-group-item">

                            @if (is_null($isDelivered))
                                @can('view', auth()->user())
                                    <form action="{{ route('orders.update', $id) }}" method="POST" class="m-0 p-0"
                                          style="display: inline-block">
                                        @csrf
                                        @method('PATCH')

                                        <div class="d-flex align-items-center">
                                            <h3 class="text-uppercase text-dark mr-3">
                                                Livré à |
                                            </h3>
                                            <div>
                                                <button type="submit"
                                                        class="btn mark-as-delivered-btn btn-sm btn-primary">
                                                    Confirmer la livraison
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endcan
                            @endif

                            @if (!is_null($isDelivered))
                                <h3 class="text-uppercase text-dark">
                                    Livré à
                                </h3>
                            @endif

                            <div class="alert {{ is_null($isDelivered) ? "alert-danger" : "alert-success" }}"
                                 role="alert">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ is_null($isDelivered) ? "Status: Pending" : $deliveredAt }}
                                    </div>
                                </div>
                            </div>

                        </li>

                        <li class="list-group-item mt-3">
                            <h3 class="text-uppercase text-dark">Article(s) commandé(s)</h3>

                            <ul class="list-group list-group-flush">

                                @foreach ($orders as $order)
                                    <li class="list-group-item">
                                        <div class="div-row">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <a href="/product/{{ $order->product_id }}">
                                                        <img
                                                            src="{{ $order->image }}"
                                                            class="img-fluid"
                                                            alt="{{ $order->name }}"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="col product-name">
                                                    <p class="text-dark font-md">
                                                        {{ $order->name }}
                                                    </p>
                                                </div>

                                                <div class="col-md-4">
                                                    <small class="text-dark font-md">
                                                        <span>{{ $order->qty }}</span> x
                                                        <span> {{ $order->amount }}€</span> =
                                                        <span> {{ ($order->qty * $order->amount) }}€</span>
                                                    </small>
                                                </div>

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
                                <div class="col lg-6">Articles:</div>
                                <div class="col lg-6">{{ $itemsCount   }}</div>
                            </div>

                            <!-- Subtotal-->
                            <div class="row py-1">
                                <div class="col lg-6">Sous-total:</div>
                                <div class="col lg-6">{{ $total  }}€</div>
                            </div>

                            <!-- TAX-->
                            <div class="row py-1">
                                <div class="col lg-6">Tax:</div>
                                <div class="col lg-6">&#8369;{{ $tax }}</div>
                            </div>

                            <!-- Shipping-->
                            <div class="row py-1">
                                <div class="col lg-6">Livraison:</div>
                                <div class="col lg-6">&#8369; 0.00</div>
                            </div>

                            <!-- Total -->
                            <div class="row py-1">
                                <div class="col lg-6">Total:</div>
                                <div class="col lg-6">
                                    <span class="fw-bold">{{ $total + $tax}}.00€</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                            <h3 class="text-uppercase">Détails client</h3>
                            <hr>

                            <!-- Subtotal Price -->
                            <div class="row py-1">
                                <div class="col lg-6">Nom:</div>
                                <div class="col lg-6">{{ $user->name }}</div>
                            </div>

                            <!-- Subtotal-->
                            <div class="row py-1">
                                <div class="col lg-6">Contact:</div>
                                <div class="col lg-6">{{ $user->phone }}</div>
                            </div>
                        </div>
                    </div>
                    {{-- END OF CUSTOMER --}}
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
