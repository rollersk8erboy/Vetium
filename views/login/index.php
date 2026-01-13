<!DOCTYPE html>
<html lang="en">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/SessionController.php';
$session_controller->index();
?>

<body>
    <form class="authentication" method="post" autocomplete="off">
        <h1 class="text-white">VETIUM</h1>
        <p class="text-white">GESTOR VETERINARIO</p>
        <div class="form-floating">
            <input type="text" class="form-control" name="username" placeholder="rollersk8erboy" required>
            <label>Usuario</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" placeholder="rollersk8erboy" required>
            <label>Contraseña</label>
        </div>
        <button class="btn" type="submit">Iniciar sesión</button>
    </form>
</body>

</html>