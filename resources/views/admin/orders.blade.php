@extends('admin.layouts.app')

@section('title')
    Commandes
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Liste des commandes</h1>
        </div>

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
                            <th>Transaction #</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $order->transaction_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F d Y') }}</td>
                                <td>
                                <span
                                    class="{{ is_null($order->deliveredAt) ? 'bg-danger' : 'bg-success' }} rounded-pill p-2 text-white my-order-status"
                                    style="font-size: 0.7rem">
                                  {{ is_null($order->deliveredAt) ? "En attente" : "Livré" }}
                                </span>
                                </td>
                                <td>
                                    <span class="btn btn-light">
                                        <a style="text-decoration: none; color: #4d4d4d;"
                                           href="/orders/{{ $order->transaction_no }}">
                                            Gérer
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
