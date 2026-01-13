<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/UserController.php';

$user = $user_controller->show($_GET['user_id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['password'] == $_POST['confirm']) {
        $user_controller->update($_GET['user_id']);
    } else {
        $alert = "Las contraseñas no coinciden.";
        require_once $_SERVER['DOCUMENT_ROOT']  . '/templates/error.php';
        die();
    }
}
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="username" pattern="[a-zA-Z0-9_]{3,15}" value="<?php echo $user['username'] ?>" required>
                    <label>Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="rollersk8erboy" name="password">
                    <label>Contraseña</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="rollersk8erboy" name="confirm">
                    <label>Confirmar contraseña</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="first_name" value="<?php echo $user['first_name'] ?>" required>
                    <label>Nombre(s)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="last_name" value="<?php echo $user['last_name'] ?>" required>
                    <label>Apellido(s)</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar usuario</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>