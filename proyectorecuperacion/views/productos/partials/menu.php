<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=URL?>productos">productos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=URL?>productos/nuevo">Nuevo</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ordenar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/1">ID</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/2">Producto</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/3">Descripcion</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/4">Categoria</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/5">Precio</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>productos/ordenar/6">Stock</a></li>
                            </ul>
                        </li>

                    </ul>
                    <form class="d-flex" method="get" action="<?=URL?>productos/buscar">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" name="expresion">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>