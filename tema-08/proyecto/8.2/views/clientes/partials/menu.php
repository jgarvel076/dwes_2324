<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=URL?>clientes">Clientes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?=(in_array($_SESSION['id_rol'],$GLOBALS['clientes']['new']))?'activate':'disabled'?>" aria-current="page" href="<?=URL?>clientes/nuevo">Nuevo</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle
                            <?=(in_array($_SESSION['id_rol'],$GLOBALS['clientes']['order']))?'activate':'disabled'?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ordenar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/1">Id</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/2">Cliente</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/6">Email</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/3">Telefono</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/5">dni</a></li>
                                <li><a class="dropdown-item" href="<?=URL?>clientes/ordenar/4">ciudad</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-link <?= (in_array($_SESSION['id_rol'], $GLOBALS['clientes']['import']) || in_array($_SESSION['id_rol'], $GLOBALS['clientes']['import'])) ? '' : 'disabled' ?>" data-bs-toggle="modal" data-bs-target="#importarModal">Importar</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?=(in_array($_SESSION['id_rol'],$GLOBALS['clientes']['export']))?'activate':'disabled'?>" aria-current="page" href="<?=URL?>clientes/exportar">Exportar</a>
                        </li>

                    </ul>
                    <form class="d-flex" method="get" action="<?=URL?>clientes/buscar">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar" name="expresion">
                        <button class="btn btn-outline-secondary
                        <?=(in_array($_SESSION['id_rol'],$GLOBALS['clientes']['filter']))?null:'disabled'?>" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>