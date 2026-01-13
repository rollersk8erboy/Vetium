<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../../controllers/BreedController.php';
require_once '../../../controllers/SpecieController.php';
require_once '../../controllers/ReferenciaController.php';
require_once '../../controllers/TiemposController.php';

$tiempos = $tiempos_controller->show($_GET['item_id']);
$referencia = $referencia_controller->show($tiempos['fk_referencia_id']);
$item = $item_controller->show($tiempos['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$tiempos_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <select class="form-select" name="fk_referencia_id">
                        <?php require_once '../../views/referencias/options.php'; ?>
                    </select>
                    <label>VALORES DE REFERENCIA</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $tiempos['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="w-25">ANALITO</th>
                                <th class="w-25 text-center">RESULTADO</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">VALORES DE REFERENCIA</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>TIEMPO DE TROMBOPLASTINA</td>
                            <td><input type="number" step="any" class="form-control" name="tiempo_de_tromboplastina" value="<?php echo $tiempos['tiempo_de_tromboplastina'] ?>"></td>
                            <td class="text-center">s</td>
                            <td class="text-center"><?php echo isset($referencia) ? $referencia['tiempo_de_tromboplastina'] : '-' ?></td>
                        </tr>
                        <tr>
                            <td>TIEMPO DE PROTOMBINA</td>
                            <td><input type="number" step="any" class="form-control" name="tiempo_de_protrombina" value="<?php echo $tiempos['tiempo_de_protrombina'] ?>"></td>
                            <td class="text-center">s</td>
                            <td class="text-center"><?php echo isset($referencia) ? $referencia['tiempo_de_protrombina'] : '-' ?></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea style="text-align: justify;" class="form-control" name="interpretaciones"><?php echo $tiempos['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIONES</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar tiempos de coagulación</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>