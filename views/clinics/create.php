<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ClinicController.php';
$clinic_controller->store();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="clinic" required>
                    <label>Clínica</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="address" required>
                    <label>Dirección</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="vet" required>
                    <label>Médico veterinario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="rollersk8erboy" name="email">
                    <label>Correo electrónico</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" placeholder="rollersk8erboy" name="phone_number">
                    <label>Teléfono</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar clínica</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>