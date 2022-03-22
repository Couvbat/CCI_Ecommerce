{{-- Navigation --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="main-color fw-600 text-size-2rem">Berry</span><span class="text-size-2rem">Pizza</span>
            <div class="line-dec"></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::url() == url('/') ? 'active' : '' }}"
                        href="{{ route('home') }}">Acceuil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::url() == url('/products') ? 'active' : '' }}"
                        href="{{ route('product.view') }}">Produits</a>
                </li>
								<li class="nav-item">
									<a class="nav-link {{ Request::url() == url('/all_categories') ? 'active' : '' }}"
											href="{{ route('category.view') }}">Categories</a>
							</li>

                <li class="nav-item">
                    <a class="nav-link align-items-center d-flex {{ Request::url() == url('/cart') ? 'active' : '' }}"
                        href="{{ route('product.cart') }}">
                        <i class="fa fa-shopping-cart"></i>
                        @auth
                            @if (Cart::instance('default')->count() > 0)
                                {{-- Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ auth()->user()->products->count() }} </span> --}}
                                Panier <span class="badge badge-pill badge-danger notify round">
                                    {{ Cart::instance('default')->count() }} </span>
                            @else
                                Panier
                            @endif
                        @else
                            @if (Cart::instance('default')->count() > 0)
                                {{-- Cart <span class="dot text-center text-dark align-middle fw-bold"> {{ auth()->user()->products->count() }} </span> --}}
                                Panier <span class="badge badge-pill badge-danger notify round">
                                    {{ Cart::instance('default')->count() }} </span>
                            @else
                                Panier
                            @endif
                        @endauth
                    </a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-user"></i>
                                Se connecter
                            </a>
                        </li>
                    @endif
                @else
                    <div class="nav-item dropdown">
												<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
												Profil
												</button>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('view', auth()->user())
                                <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                            @endcan
                            <li><a class="dropdown-item" href="/profiles">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('my_orders') }}">Mes commandes</a></li>
                            {{-- LOGOUT --}}
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                {{ __('Deconnexion') }}
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @endguest
            </ul>
        </div>
</nav>
