<!-- Sidebar -->
<ul
    class="navbar-nav sidebar sidebar-dark accordion bg-gradient-primary"
    id="accordionSidebar"
>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#page_top">
        <div class="sidebar-brand-icon ">
            <span class="text-info">Berry</span>Pizza
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0"/>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ Request::url() == url('/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
        >
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider"/>

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Tables -->
    <li class="nav-item  {{ Request::url() == url('/products') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-luggage-cart"></i>
            <span>Produits</span></a
        >
    </li>

		<li class="nav-item  {{ Request::url() == url('/categories') ? 'active' : '' }}">
			<a class="nav-link" href="{{ route('categories.index') }}">
					<i class="fas fa-list"></i>
					<span>Categories</span></a
			>
	</li>

    <li class="nav-item {{ Request::url() == url('/orders') ? 'active' : '' }}">
        <a class="nav-link" href="/orders">
            <i class="fas fa-truck"></i>
            <span>Commandes</span>
        </a>
    </li>

    <li class="nav-item {{ Request::url() == url('/users') ? 'active' : '' }}">
        <a class="nav-link" href="/users">
            <i class="fas fa-user"></i>
            <span>Utilisateurs</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->
