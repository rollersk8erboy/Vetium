<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/CoproparasitoscopicoController.php';

$coproparasitoscopico = $coproparasitoscopico_controller->show($_GET['item_id']);
$item = $item_controller->show($coproparasitoscopico['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$coproparasitoscopico_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="prueba"><?php echo $coproparasitoscopico['prueba'] ?></textarea>
                    <label>PRUEBA</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <td><input type="date" step="any" class="form-control" name="fecha_1" value="<?php echo $coproparasitoscopico['fecha_1'] ?>"></td>
                            <label>FECHA</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <textarea oninput="resizeArea(this)" class="form-control" name="resultado_1"><?php echo $coproparasitoscopico['resultado_1'] ?></textarea>
                            <label>MUESTRA I</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <td><input type="date" step="any" class="form-control" name="fecha_2" value="<?php echo $coproparasitoscopico['fecha_2'] ?>"></td>
                            <label>FECHA</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <textarea oninput="resizeArea(this)" class="form-control" name="resultado_2"><?php echo $coproparasitoscopico['resultado_2'] ?></textarea>
                            <label>MUESTRA II</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <td><input type="date" step="any" class="form-control" name="fecha_3" value="<?php echo $coproparasitoscopico['fecha_3'] ?>"></td>
                            <label>FECHA</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <textarea oninput="resizeArea(this)" class="form-control" name="resultado_3"><?php echo $coproparasitoscopico['resultado_3'] ?></textarea>
                            <label>MUESTRA III</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar coproparasitoscópico</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>