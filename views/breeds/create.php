<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/SpecieController.php';
require_once '../../controllers/BreedController.php';
$breed_controller->store();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <select class="form-select" name="fk_specie_id" onchange="getBreeds()" required>
                        <?php require_once '../../views/species/options.php'; ?>
                    </select>
                    <label>Especie</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="breed" required>
                    <label>Raza</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar raza</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>