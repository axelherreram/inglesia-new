<div class="primary-menu">
    <nav class="navbar navbar-expand-lg align-items-center">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header border-bottom">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                    <div class="">
                        <img src="{{ asset('/assets/icon/iglesia.png') }}" class="logo-icon" alt="logo icon">
                    </div>
                    <div class="">
                        <h4 class="logo-text fw-bold">Iglesia Sansare</h4>
                    </div>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-center justify-content-center flex-grow-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"> <img src="{{ asset('/assets/icon/bautismo.svg') }}"
                                    class="logo-icon" alt="logo icon">
                                </i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Bautizos</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="/dashboard-bautizo-create">
                                    <i class="fadeIn animated bx bx-news"></i>
                                    Nuevo bautizo
                                </a>
                            </li>
                            <li><a class="dropdown-item " href="/dashboard-list-bautizo">
                                    <i class='fadeIn animated bx bx-search-alt-2'></i>
                                    Buscar bautizo
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"> <img src="{{ asset('/assets/icon/comunion.svg') }}"
                                    class="logo-icon" alt="logo icon" style="height: 50px">
                                </i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Comunión</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item m-0" href="/dashboard-comunion-create">
                                    <i class="fadeIn animated bx bx-news"></i>
                                    Nueva comunión
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="/dashboard-list-comunion">
                                    <i class='fadeIn animated bx bx-search-alt-2'></i>
                                    Buscar Comunión
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"> <img src="{{ asset('/assets/icon/confirmacion.svg') }}"
                                    class="logo-icon" alt="logo icon">
                                </i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Confirmación</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item m-0" href="/dashboard-confirmacion-create">
                                    <i class="fadeIn animated bx bx-news"></i>
                                    Nueva Confirmación
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="/dashboard-list-confirmacion">
                                    <i class='fadeIn animated bx bx-search-alt-2'></i>
                                    Buscar Confirmación
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon">
                                <img src="{{ asset('/assets/icon/casamiento.svg') }} " class="logo-icon" alt="logo icon"
                                    style="width: 50px">
                            </div>
                            <div class="menu-title d-flex align-items-center">Casamientos</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item m-0" href="/dashboard-casamiento-create">
                                    <i class="fadeIn animated bx bx-news"></i>
                                    Nuevo casamiento
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="/dashboard-list-casamiento">
                                    <i class='fadeIn animated bx bx-search-alt-2'></i>
                                    Buscar Casamientos
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--    
              <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"> <img src="{{ asset('/assets/icon/socios.png') }}"
                                    class="logo-icon" alt="logo icon">
                                </i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Ingreso de personas</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item m-0" href="/crear-persona">
                                    <i class="fadeIn animated bx bx-news"></i>
                                    Nueva persona
                                </a>
                            </li>
                        </ul>
                    </li>
 --}}
                    {{-- 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"><i class='bx bx-home-alt'></i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Dashboard</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('index') }}"><i
                                        class='bx bx-pie-chart-alt'></i>Default</a></li>
                            <li><a class="dropdown-item" href="{{ url('dashboard-alternate') }}"><i
                                        class='bx bx-shield-alt-2'></i>Alternate</a></li>
                            <li><a class="dropdown-item" href="{{ url('dashboard-analytics') }}"><i
                                        class='bx bx-line-chart'></i>Graphical</a></li>
                        </ul>
                    </li> --}}


                    {{-- 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"><i class='bx bx-lock'></i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Authentication</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropend">
                                <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                    href="javascript:;"><i class='bx bx-receipt'></i>Basic</a>
                                <ul class="dropdown-menu submenu">
                                    <li><a class="dropdown-item" href="{{ url('auth-basic-signin') }}"><i
                                                class='bx bx-radio-circle'></i>Sign In</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-basic-signup') }}"><i
                                                class='bx bx-radio-circle'></i>Sign Up</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-basic-forgot-password') }}"><i
                                                class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-basic-reset-password') }}"><i
                                                class='bx bx-radio-circle'></i>Reset Password</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropend">
                                <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                    href="javascript:;"><i class='bx bx-cylinder'></i>Cover</a>
                                <ul class="dropdown-menu submenu">
                                    <li><a class="dropdown-item" href="{{ url('auth-cover-signin') }}"><i
                                                class='bx bx-radio-circle'></i>Sign In</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-cover-signup') }}"><i
                                                class='bx bx-radio-circle'></i>Sign Up</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-cover-forgot-password') }}"><i
                                                class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-cover-reset-password') }}"><i
                                                class='bx bx-radio-circle'></i>Reset Password</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropend">
                                <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                    href="javascript:;"><i class='bx bx-aperture'></i>Header & Footer</a>
                                <ul class="dropdown-menu submenu">
                                    <li><a class="dropdown-item" href="{{ url('auth-header-footer-signin') }}"><i
                                                class='bx bx-radio-circle'></i>Sign In</a></li>
                                    <li><a class="dropdown-item" href="{{ url('auth-header-footer-signup') }}"><i
                                                class='bx bx-radio-circle'></i>Sign Up</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('auth-header-footer-forgot-password') }}"><i
                                                class='bx bx-radio-circle'></i>Forgot Password</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('auth-header-footer-reset-password') }}"><i
                                                class='bx bx-radio-circle'></i>Reset Password</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"><i class='bx bx-line-chart'></i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Charts</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('charts-apex-chart') }}"><i
                                        class='bx bx-bar-chart-alt-2'></i>Apex</a></li>
                            <li><a class="dropdown-item" href="{{ url('charts-chartjs') }}"><i
                                        class='bx bx-line-chart'></i>Chartjs</a></li>
                            <li><a class="dropdown-item" href="{{ url('charts-highcharts') }}"><i
                                        class='bx bx-pie-chart-alt'></i>HighCharts</a></li>
                            <li class="nav-item dropend">
                                <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                    href="javascript:;"><i class='bx bx-map-pin'></i>Maps</a>
                                <ul class="dropdown-menu submenu">
                                    <li><a class="dropdown-item" href="{{ url('map-google-maps') }}"><i
                                                class='bx bx-radio-circle'></i>Google Maps</a></li>
                                    <li><a class="dropdown-item" href="{{ url('map-vector-maps') }}"><i
                                                class='bx bx-radio-circle'></i>Vector Maps</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon"><i class="bx bx-grid-alt"></i>
                            </div>
                            <div class="menu-title d-flex align-items-center">Tables</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('table-basic-table') }}"><i
                                        class='bx bx-table'></i>Basic Table</a></li>
                            <li><a class="dropdown-item" href="{{ url('table-datatable') }}"><i
                                        class='bx bx-data'></i>Data Table</a></li>
                        </ul>
                    </li>
                 --}}
                </ul>
            </div>
        </div>
    </nav>
</div>
