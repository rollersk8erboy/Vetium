<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/SpecieController.php';
require_once '../../controllers/BreedController.php';
$specie = $specie_controller->show($_GET['specie_id']);
$breeds = $breed_controller->index($_GET['specie_id']);
$specie_controller->update($_GET['specie_id']);
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="specie" value="<?php echo $specie['specie'] ?>" required>
                    <label>Especie</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar especie</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>