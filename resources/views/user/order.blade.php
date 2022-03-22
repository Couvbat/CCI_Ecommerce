@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

<section id="order">

      <div class="container">
        <div class="row pt-2 pb-5">

          {{-- START OF CARD --}}
          <div class="col">

            <h3>Mes commandes</h3>

            @if (count($order) > 0)
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="col">Commande#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($order as $key => $product)
                <tr>
                  <td>{{ $product->transaction_no }}</td>
                  <td>{{ \Carbon\Carbon::parse($product->created_at)->format('F d Y') }}</td>
                  <td>
                      <span
                      class="{{ is_null($product->deliveredAt) ? 'bg-danger' : 'bg-success' }} rounded-pill p-2 text-white my-order-status"
                      style="font-size: 0.7rem">
                      {{ is_null($product->deliveredAt) ? "Pending" : "Received" }}
                    </span>
                  </td>
                  <td><span class="btn btn-light"><a style="text-decoration: none; color: #4d4d4d;" href="/orders/{{ $product->transaction_no }}">Gerer</a></span></td>

                </tr>
                @endforeach

                @else

                <div class="alert alert-info" style="margin-bottom: 10rem;" role="alert">
                  Vous n'avez aucune commande <a href="{{ route('home') }}" class="alert-link">Retour</a>
                </div>

                @endif



              </tbody>
            </table>
            </div>
            {{-- END OF CARD --}}

          </div>
        </div>

    </section>


@endsection
