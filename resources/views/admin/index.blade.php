@extends('admin.layouts.app')


@section('title') Dashboard @endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <h1 class="h3 mb-0 text-gray-800 my-10">Dashboard</h1>
        <div id="page-content">
            <div class="row pt-4">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div
                                        class="
                              text-xs
                              font-weight-bold
                              text-primary text-uppercase
                              mb-1
                            "
                                    >
                                        Commandes (Aujourd'hui)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $ordersToday->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div
                                        class="
                              text-xs
                              font-weight-bold
                              text-success text-uppercase
                              mb-1
                            "
                                    >
                                        Gains (ce mois-ci)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
																				{{ $earningsThisMonth }}&#8364;
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div
                                        class="
                              text-xs
                              font-weight-bold
                              text-info text-uppercase
                              mb-1
                            "
                                    >
                                        Produits
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div
                                                class="
                                  h5
                                  mb-0
                                  mr-3
                                  font-weight-bold
                                  text-gray-800
                                "
                                            >
                                                {{ $products }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i
                                        class="fas fa-clipboard-list fa-2x text-gray-300"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs
                              font-weight-bold
                              text-warning text-uppercase
                              mb-1">
																				Commandes en attentes
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $orders->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    "
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Client(s) avec commande (Aujourd'hui)
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered"
                                id="dataTable"
                                width="100%"
                                cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Prénom</th>
                                    <th>Nom de famille</th>
                                    <th>Email</th>
                                    <th>Numero de téléphone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><img src="{{ $user->avatar }}" style="border-radius: 50%;" width="35"
                                                 height="35" class="img-fluid"
                                                 alt="dp"></td>
                                        <td>{{ $user->firstName }}</td>
                                        <td>{{ $user->lastName }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    "
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Meilleurs produits
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered"
                                id="dataTable"
                                width="100%"
                                cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Nom</th>
                                    <th>Ventes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>
                                            <img src="{{ $sale->image }}" style="border-radius: 50%;" width="30"
                                                 height="30" class="img-fluid"
                                                 alt="dp">
                                        </td>
                                        <td>{{ $sale->name }}</td>
                                        <td>{{ $sale->sales_count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@section('extra-js')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
