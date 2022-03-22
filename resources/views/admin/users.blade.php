@extends('admin.layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Utilisateurs enregistrés</h1>
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
	                          <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numero de téléphone</th>
                            <th>Member Since</th>
                            <th style="min-width: 20px !important;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->firstName }}
                                </td>
																<td>
                                    {{ $user->lastName }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
																<td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    {{ $user->created_at }}
                                </td>
                                <td>
                                    <form action="/users/{{ $user->id }}" method="POST"
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
    <!-- /.container-fluid -->
@endsection
