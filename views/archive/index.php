<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/CaseController.php';
$cases = $case_controller->index();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <?php require_once '../../templates/search.php'; ?>
        <div class="card bg-light">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Caso</th>
                                <th>Fecha de apertura</th>
                                <th>Estado de entrega</th>
                                <th>Estado de pago</th>
                                <th>Total</th>
                                <th>Porcentaje de pago</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($case = $cases->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$case['case_number']} </td>";
                                echo "<td>" . (new IntlDateFormatter('es-ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Merida', IntlDateFormatter::GREGORIAN, "d 'de' LLLL 'de' yyyy  (h:mm a)"))->format(new DateTime($case['opening_date'])) . "</td>";
                                echo "<td> {$case['delivery_status']} </td>";
                                echo "<td> {$case['payment_status']} </td>";
                                echo "<td> {$case['total']} </td>";
                                $color = ($case['payment_status'] == 'PARCIALMENTE PAGADO' ? 'bg-danger' : ($case['payment_status'] == 'PAGADO' ? 'bg-success' : ''));
                                echo "<td> 
                                    <div class='progress progress-bar-striped' aria-valuenow='{$case['payment_percentage']}' aria-valuemin='0' aria-valuemax='100'>
                                        <div class='progress-bar progress-bar-striped $color' style='width: {$case['payment_percentage']}'>{$case['payment_percentage']}</div>
                                    </div>
                                </td>";
                                echo
                                "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-primary' href='/views/archive/show.php?case_id={$case['case_id']}'>Visualizar</a>
                                        <a class='btn btn-warning' href='/views/archive/edit.php?case_id={$case['case_id']}'>Editar</a>
                                        <a class='btn btn-danger' href='/views/archive/destroy.php?case_id={$case['case_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
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
                    <a class="btn btn-success" href="/views/archive/create.php">Crear nuevo caso</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>