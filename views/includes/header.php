<!-- /views/includes/header.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Tickets</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=ticket&action=crear">Crear Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=ticket&action=listar">Ver Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=usuario&action=logout">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
