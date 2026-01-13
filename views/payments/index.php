<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/PaymentController.php';
$payments = $payment_controller->summary();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <?php require_once '../../templates/search.php'; ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Caso</th>
                                <th>Abono</th>
                                <th>Método de pago</th>
                                <th>Realizado</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($payment = $payments->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$payment['case_number']} </td>";
                                echo "<td> {$payment['payment']} </td>";
                                echo "<td> {$payment['payment_type']} </td>";
                                echo "<td>" . (new IntlDateFormatter('es-ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Mexico_City', IntlDateFormatter::GREGORIAN, "d 'de' LLLL 'de' yyyy  (h:mm a)"))->format(new DateTime($payment['payment_date'])) . "</td>";
                                echo "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-primary' href='/views/home/show.php?case_id={$payment['case_id']}'>Visualizar</a>
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
                    <a class="btn btn-success" href="/views/home/create.php">Crear nuevo caso</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>