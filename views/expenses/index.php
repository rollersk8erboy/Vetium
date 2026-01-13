<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ExpenseController.php';
$expenses = $expense_controller->index();
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
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Fecha de gasto</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($expense = $expenses->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$expense['description']} </td>";
                                echo "<td> {$expense['amount']} </td>";
                                echo "<td>" . (new IntlDateFormatter('es-ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Merida', IntlDateFormatter::GREGORIAN, "d 'de' LLLL 'de' yyyy  (h:mm a)"))->format(new DateTime($expense['expense_date'])) . "</td>";
                                echo
                                "<td>
                                    <div class='btn-group'>
                                        <a class='btn btn-warning' href='/views/expenses/edit.php?expense_id={$expense['expense_id']}'>Editar</a>
                                        <a class='btn btn-danger' href='/views/expenses/destroy.php?expense_id={$expense['expense_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
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
                    <a class="btn btn-success" href="/views/expenses/create.php">Crear nuevo gasto</a>
                </div>
            </div>
        </div>
        <?php require_once '../../templates/pagination.php'; ?>
    </div>
</body>

</html>