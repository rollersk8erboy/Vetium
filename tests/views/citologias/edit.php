<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/CitologiaController.php';

$citologia = $citologia_controller->show($_GET['item_id']);
$item = $item_controller->show($citologia['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$citologia_controller->update($_GET['item_id'], $case['case_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $citologia['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="descripcion_macroscopica_de_la_lesion"><?php echo $citologia['descripcion_macroscopica_de_la_lesion'] ?></textarea>
                    <label>DESCRIPCIÓN MACROSCÓPICA DE LA LESIÓN</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="descripcion_citologica"><?php echo $citologia['descripcion_citologica'] ?></textarea>
                    <label>DESCRIPCIÓN CITOLÓGICA</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $citologia['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIÓN</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="diagnostico"><?php echo $citologia['diagnostico'] ?></textarea>
                    <label>DIAGNÓSTICO</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="comentario"><?php echo $citologia['comentario'] ?></textarea>
                    <label>COMENTARIO</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar citología</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>