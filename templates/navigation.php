<div class="navbar">
    <div class="header">
        <button onclick="toggleSidebar()"><i class='fas fa-bars'></i></button>
    </div>
</div>

<div class="sidebar">
    <div class="title">
        <h2>VETIUM</h2>
        <p>GESTOR VETERINARIO</p>
    </div>
    <div class="body">
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/home/') !== false ? 'active' : ''; ?>">
            <a href="/views/home/index.php"><i class='fas fa-home fa-fw'></i> Inicio</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/clinics/') !== false ? 'active' : ''; ?>">
            <a href="/views/clinics/index.php"><i class='fas fa-clinic-medical fa-fw'></i> Clínicas</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/species/') !== false ? 'active' : ''; ?>">
            <a href="/views/species/index.php"><i class='fas fa-cat fa-fw'></i> Especies</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/breeds/') !== false ? 'active' : ''; ?>">
            <a href="/views/breeds/index.php"><i class='fas fa-paw fa-fw'></i> Razas</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/studies/') !== false ? 'active' : ''; ?>">
            <a href="/views/studies/index.php"><i class='fas fa-file-medical-alt fa-fw'></i> Estudios</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/payments/') !== false ? 'active' : ''; ?>">
            <a href="/views/payments/index.php"><i class='fas fa-donate fa-fw'></i> Ganancias</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/expenses/') !== false ? 'active' : ''; ?>">
            <a href="/views/expenses/index.php"><i class='fas fa-dollar-sign fa-fw'></i> Gastos</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/users/') !== false ? 'active' : ''; ?>">
            <a href="/views/users/index.php"><i class='fas fa-user-friends fa-fw'></i> Usuarios</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/referencias/') !== false ? 'active' : ''; ?>">
            <a href="/tests/views/referencias/index.php"><i class='fas fa-calculator fa-fw'></i> Referencias</a>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], '/archive/') !== false ? 'active' : ''; ?>">
            <a href="/views/archive/index.php"><i class='fas fa-folder-open fa-fw'></i> Archivados</a>
        </li>
        <li>
            <a href="/views/login/destroy.php" class="article" onclick='return confirm("¿Está seguro de que desea cerrar sesión?");'><i class="fas fa-arrow-left fa-fw"></i> Cerrar sesión</a>
        </li>
    </div>
</div>