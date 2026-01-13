<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/UserController.php';
$user_controller->store();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="username" pattern="[a-zA-Z0-9_]{3,15}" title="Debe contener solo letras, números y guiones bajos (_) y tener una longitud de 3 a 15 caracteres." required>
                    <label>Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="rollersk8erboy" name="password" required>
                    <label>Contraseña</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="first_name" required>
                    <label>Nombre(s)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="last_name" required>
                    <label>Apellido(s)</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar usuario</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>