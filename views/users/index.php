<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/UserController.php';
$users = $user_controller->index();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <?php require_once '../../templates/search.php'; ?>
        <div class="card bg-light">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre(s)</th>
                                <th>Apellido(s)</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user = $users->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$user['username']} </td>";
                                echo "<td> {$user['first_name']} </td>";
                                echo "<td> {$user['last_name']} </td>";
                                echo
                                "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-warning' href='/views/users/edit.php?user_id={$user['user_id']}'>Editar</a>
                                        <a class='btn btn-danger' href='/views/users/destroy.php?user_id={$user['user_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
                                        </div>
                                    </div>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-success" href="/views/users/create.php">Crear nuevo usuario</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>