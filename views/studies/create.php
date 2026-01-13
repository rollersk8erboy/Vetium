<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/StudyController.php';
$study_controller->store();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="study" required>
                    <label>Estudio</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" step=".01" class="form-control" placeholder="rollersk8erboy" name="public_price" required>
                    <label>Precio normal</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" step=".01" class="form-control" placeholder="rollersk8erboy" name="vet_price" required>
                    <label>Precio especial</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar estudio</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>