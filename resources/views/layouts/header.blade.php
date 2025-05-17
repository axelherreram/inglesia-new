    <!--start header wrapper-->
    <div class="header-wrapper">
        <header>
            <div class="topbar d-flex align-items-center ">
                <a href="{{ route('dashboard') }}" class="topbar-logo-header d-none d-lg-flex align-items-center text-decoration-none p-2">
                    <div class="d-flex align-items-center justify-content-center bg-light ">
                        <img src="{{ asset('/assets/icon/icono.png') }}"  width="200" alt="logo icon" >
                    </div>
                </a>
                <div class="mobile-toggle-menu d-block d-lg-none" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar"><i class='bx bx-menu'></i></div>

                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">

                    </ul>
                </div>
                <div class="user-box dropdown px-3">
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/assets/img/iglesia-1.png') }}" class="user-img" alt="user avatar">
                        <div class="user-info">
                            <!-- Mostrar el nombre del usuario autenticado -->
                            @if (Auth::check())
                                <p class="user-name mb-0">{{ Auth::user()->nombres }} 
                                </p>
                            @else
                                <p class="user-name mb-0">Usuario</p>
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item d-flex align-items-center" href="/user-profile"><i
                                    class="bx bx-user fs-5"></i><span>Perfil</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bx bx-log-out-circle"></i><span>Cerrar Sesión</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                </nav>
            </div>
        </header>
    </div>
    <!-- Page wrapper end -->
