<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/StudyController.php';
$studies = $study_controller->index();
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
                                <th>Estudio</th>
                                <th>Precio normal</th>
                                <th>Precio especial</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($study = $studies->fetch_assoc()) {

                                echo "<tr>";
                                echo "<td> {$study['study']} </td>";
                                echo "<td> {$study['public_price']} </td>";
                                echo "<td> {$study['vet_price']} </td>";
                                echo
                                "<td class='col-2'>
                                    <div class='btn-group d-flex'>
                                    <a class='btn btn-warning' href='/views/studies/edit.php?study_id={$study['study_id']}'>Editar</a>
                                    <a class='btn btn-danger' href='/views/studies/destroy.php?study_id={$study['study_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
                                    </div>
                                </td>";
                            }
                            echo "</tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-success" href="/views/studies/create.php">Crear nuevo estudio</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>