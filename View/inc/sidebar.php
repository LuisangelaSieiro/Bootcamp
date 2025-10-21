
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo APP_NAME; ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo APP_URL; ?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Registrar:</h6>
                <a class="collapse-item" href="<?php echo APP_URL; ?>user-new">Usuario</a>
                <a class="collapse-item" href="<?php echo APP_URL; ?>user-type-new">Tipo Usuario</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
            aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Maestros
            </span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Registrar:</h6>
                <a class="collapse-item" href="">Ocupacion</a>
                <a class="collapse-item" href="">Trabajador</a>
                <a class="collapse-item" href="">Tareas</a>
                <a class="collapse-item" href="">Otros</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Movimientos
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMotion"
            aria-expanded="true" aria-controls="collapseMotion">
            <i class="fas fa-fw fa-random"></i>
            <span>Transacciones</span>
        </a>
        <div id="collapseMotion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Movimiento 1:</h6>
                <a class="collapse-item" href="">Pagos</a>
                
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Movimiento 2:</h6>
                <a class="collapse-item" href="">solicitudes</a>
                
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Reportes
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
            aria-expanded="true" aria-controls="collapseReport">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>informe.</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reporte 1:</h6>
                <a class="collapse-item" href="">Pagos</a>
                
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Reporte 2:</h6>
                <a class="collapse-item" href="">solicitudes</a>
                
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>