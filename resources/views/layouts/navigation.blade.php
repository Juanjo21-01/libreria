<div class="sidebar border col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary " tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Libreria</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-house-fill"></i>
                        Panel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('productos.index') }}">
                        <i class="bi bi-columns-gap"></i>
                        Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('compras.index') }}">
                        <i class="bi bi-bag"></i>
                        Compras
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('ventas.index') }}">
                        <i class="bi bi-cart3"></i>
                        Ventas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('proveedores.index') }}">
                        <i class="bi bi-person-circle"></i>
                        Proveedores
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-2 text-body-secondary text-uppercase">
                <span>Reportes</span>
            </h6>
            <ul class="nav flex-column mb-auto ">
                <li class="nav-item ">
                    <a class="nav-link d-flex align-items-center gap-2 text-success" href="#">
                        <i class="bi bi-calendar-check"></i>
                        Hoy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-success" href="#">
                        <i class="bi bi-calendar3"></i>
                        Fecha
                    </a>
                </li>
            </ul>

            <hr class="my-3">


            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-body-secondary text-uppercase">
                <span>Usuario {{ Auth::user()->name }}</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-danger" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-lines-fill"></i>
                        Perfil
                    </a>
                </li>
                <li class="nav-item text-center my-md-5 py-md-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="btn btn-danger m-1 bg-gradient" href="#"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Cerrar Sesión
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </form>
                </li>
            </ul>
            <hr class="my-2 border-0">
        </div>
    </div>
</div>
