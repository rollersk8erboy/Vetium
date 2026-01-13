<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/SpecieController.php';
$species = $specie_controller->index();
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
                                <th>Especie</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($specie = $species->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$specie['specie']} </td>";
                                echo
                                "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-warning' href='/views/species/edit.php?specie_id={$specie['specie_id']}'>Editar</a>
                                        <a class='btn btn-danger' href='/views/species/destroy.php?specie_id={$specie['specie_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
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
                    <a class="btn btn-success" href="/views/species/create.php">Crear nueva especie</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>