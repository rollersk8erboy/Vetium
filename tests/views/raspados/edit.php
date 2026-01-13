<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/RaspadoController.php';

$raspado = $raspado_controller->show($_GET['item_id']);
$item = $item_controller->show($raspado['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$raspado_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $raspado['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="resultado"><?php echo $raspado['resultado'] ?></textarea>
                    <label>RESULTADO</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar raspado</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>