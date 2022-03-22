<!-- Topbar -->
<nav
    class="
              navbar navbar-expand navbar-light
              bg-white
              topbar
              mb-4
              static-top
              shadow
            "
>
    <!-- Sidebar Toggle (Topbar) -->
    <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3"
    >
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropstart no-arrow">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
					Admin
					</button>
            <!-- Dropdown - User Information -->
            <div
                class="
                    dropdown-menu dropdown-menu-right
                    shadow
                    animated--grow-in
                  "
                aria-labelledby="userDropdown"
            >

                <a class="dropdown-item" href="/">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                    Acceuil
                </a>
                <a class="dropdown-item" href="/profiles">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>

                <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal"
                >
                    <i
                        class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Deconnexion
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
