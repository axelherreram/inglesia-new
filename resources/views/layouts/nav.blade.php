<style>
    /* Estilos para el cuerpo del offcanvas y los elementos de navegación */
    .offcanvas-body {
        padding: 1.25rem 1rem;
    }

    /* Estilos para la lista de navegación */
    .navbar-nav {
        width: 100%;
        gap: 0.5rem;
    }

    /* Estilos para los items del menú */
    .nav-item.dropdown {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .nav-item.dropdown:hover {
        background-color: rgba(74, 108, 247, 0.05);
    }

    /* Estilos para los enlaces del menú */
    .nav-link.dropdown-toggle {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .nav-link.dropdown-toggle:hover {
        background-color: rgba(74, 108, 247, 0.08);
    }

    /* Estilos para los iconos principales */
    .parent-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 10px;
        margin-right: 12px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .parent-icon img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    /* Colores específicos para cada sección */
    .nav-item:nth-child(1) .parent-icon {
        background-color: rgba(74, 108, 247, 0.1);
    }

    .nav-item:nth-child(2) .parent-icon {
        background-color: rgba(54, 185, 204, 0.1);
    }

    .nav-item:nth-child(3) .parent-icon {
        background-color: rgba(231, 74, 59, 0.1);
    }

    .nav-item:nth-child(4) .parent-icon {
        background-color: rgba(28, 200, 138, 0.1);
    }

    .nav-item:nth-child(5) .parent-icon {
        background-color: rgba(246, 194, 62, 0.1);
    }

    /* Estilos para el título del menú */
    .menu-title {
        font-weight: 500;
        font-size: 0.95rem;
        color: #444;
    }

    /* Estilos para el icono de flecha */
    .dropy-icon {
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .dropy-icon i {
        font-size: 1.1rem;
        color: #777;
    }

    .nav-link[aria-expanded="true"] .dropy-icon {
        transform: rotate(180deg);
    }

    /* Estilos para el menú desplegable */
    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        padding: 0.75rem 0;
        margin-top: 0.5rem;
        min-width: 220px;
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Estilos para los items del dropdown */
    .dropdown-item {
        padding: 0.7rem 1.25rem;
        display: flex;
        align-items: center;
        color: #555;
        font-size: 0.9rem;
        border-radius: 6px;
        margin: 0 0.5rem;
        transition: all 0.2s ease;
    }

    .dropdown-item i {
        margin-right: 10px;
        font-size: 1.1rem;
        opacity: 0.8;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(74, 108, 247, 0.08);
        color: #4a6cf7;
    }

    .dropdown-item:hover i {
        opacity: 1;
        color: #4a6cf7;
    }

    /* Animación para los iconos */
    .fadeIn.animated {
        animation: fadeInIcon 0.5s ease;
    }

    @keyframes fadeInIcon {
        from {
            opacity: 0;
            transform: translateX(-5px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Estilos responsivos */
    @media (max-width: 992px) {
        .navbar-nav {
            padding: 0.5rem 0;
        }

        .nav-link.dropdown-toggle {
            padding: 0.85rem 1rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none;
            background-color: rgba(74, 108, 247, 0.03);
            padding: 0.5rem;
            margin-top: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
        }
    }
</style>
<div class="primary-menu">
    <nav class="navbar navbar-expand-lg align-items-center">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
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
                            <div class="parent-icon">
                                <img src="{{ asset('/assets/icon/person.png') }}" class="logo-icon" alt="logo icon">
                            </div>
                            <div class="menu-title d-flex align-items-center">Personas</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('personas.create') }}">
                                    <i class="fadeIn animated bx bx-plus-circle"></i>
                                    Nueva persona
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('personas.index') }}">
                                    <i class='fadeIn animated bx bx-list-ul'></i>
                                    Ver personas
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon">
                                <img src="{{ asset('/assets/icon/bautismo.svg') }}" class="logo-icon" alt="logo icon">
                            </div>
                            <div class="menu-title d-flex align-items-center">Bautizos</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('bautizos.create') }}">
                                    <i class="fadeIn animated bx bx-plus-circle"></i>
                                    Nuevo bautizo
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('bautizos.index') }}">
                                    <i class='fadeIn animated bx bx-list-ul'></i>
                                    Buscar bautizo
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon">
                                <img src="{{ asset('/assets/icon/comunion.svg') }}" class="logo-icon" alt="logo icon">
                            </div>
                            <div class="menu-title d-flex align-items-center">Comunión</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('comuniones.create') }}">
                                    <i class="fadeIn animated bx bx-plus-circle"></i>
                                    Nueva comunión
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('comuniones.index') }}">
                                    <i class='fadeIn animated bx bx-list-ul'></i>
                                    Buscar Comunión
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                            data-bs-toggle="dropdown">
                            <div class="parent-icon">
                                <img src="{{ asset('/assets/icon/confirmacion.svg') }}" class="logo-icon"
                                    alt="logo icon">
                            </div>
                            <div class="menu-title d-flex align-items-center">Confirmación</div>
                            <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('confirmaciones.create') }}">
                                    <i class="fadeIn animated bx bx-plus-circle"></i>
                                    Nueva Confirmación
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('confirmaciones.index') }}">
                                    <i class='fadeIn animated bx bx-list-ul'></i>
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
                </ul>
            </div>
        </div>
    </nav>
</div>