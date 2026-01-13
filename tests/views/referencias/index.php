<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../controllers/ReferenciaController.php';
$referencias = $referencia_controller->index();
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <?php require_once '../../../templates/search.php'; ?>
        <div class="card bg-light">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Especie</th>
                                <th>Descripción</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($referencia = $referencias->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$referencia['specie']} </td>";
                                echo "<td> {$referencia['descripcion']} </td>";
                                echo
                                "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-warning' href='/tests/views/referencias/edit.php?referencia_id={$referencia['referencia_id']}'>Editar</a>
                                        <a class='btn btn-danger' href='/tests/views/referencias/destroy.php?referencia_id={$referencia['referencia_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
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
                    <a class="btn btn-success" href="/tests/views/referencias/create.php">Crear nueva referencia</a>
                </div>
            </div>
        </div>
        <?php require_once '../../../templates/pagination.php'; ?>
    </div>
</body>

</html>