<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ExpenseController.php';
$expense = $expense_controller->show($_GET['expense_id']);
$expense_controller->update($_GET['expense_id']);
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="description" value="<?php echo $expense['description'] ?>" required>
                    <label>Descripción</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="number" step=".01" class="form-control" placeholder="rollersk8erboy" name="amount" value="<?php echo $expense['amount'] ?>" required>
                    <label>Monto</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar gasto</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>