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
require_once '../../controllers/KController.php';

$k = $k_controller->show($_GET['item_id']);
$item = $item_controller->show($k['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencia = $referencia_controller->show($k['fk_referencia_id']);
$k_controller->update($_GET['item_id'], $case['case_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <select class="form-select" name="fk_referencia_id">
                        <?php require_once '../../views/referencias/options.php'; ?>
                    </select>
                    <label>VALORES DE REFERENCIA</label>
                </div>
                <div class="form-floating mb-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $k['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ANALITO</th>
                                <th>DATO</th>
                                <th class="text-center">RESULTADO</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">VALORES DE REFERENCIA</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>COLESTEROL</td>
                            <td><input type="number" step="any" class="form-control" name="colesterol" value="<?php echo $k['colesterol'] ?>"></td>
                            <td class="text-center"><?php echo $k['colesterol'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['colesterol']) ? $referencia['colesterol'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>T4 LIBRE</td>
                            <td><input type="number" step="any" class="form-control" name="t4_libre" value="<?php echo $k['t4_libre'] ?>"></td>
                            <td class="text-center"><?php echo $k['t4_libre'] ?></td>
                            <td class="text-center">pmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['t4_libre']) ? $referencia['t4_libre'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>K</td>
                            <td><input disabled type="number" step="any" class="form-control" name="k"></td>
                            <td class="text-center"><?php echo $k['k'] ?></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="diagnostico"><?php echo $k['diagnostico'] ?></textarea>
                    <label>DIAGNÓSTICO</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="valores_de_referencia"><?php echo $k['valores_de_referencia'] ?></textarea>
                    <label>VALORES DE REFERENCIA</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar valor de K</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>