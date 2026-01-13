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
require_once '../../controllers/PruebasController.php';

$pruebas = $pruebas_controller->show($_GET['item_id']);
$referencia = $referencia_controller->show($pruebas['fk_referencia_id']);
$item = $item_controller->show($pruebas['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$pruebas_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <select class="form-select" name="fk_referencia_id">
                        <?php require_once '../../views/referencias/options.php'; ?>
                    </select>
                    <label>VALORES DE REFERENCIA</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="w-25">ANALITO</th>
                                <th>DATO</th>
                                <th class="w-25 text-center">RESULTADO</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">VALORES DE REFERENCIA</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="number" step="any" class="form-control" name="hematocrito" value="<?php echo $pruebas['hematocrito'] ?>"></td>
                            <td class="text-center"><?php echo $pruebas['hematocrito'] ?></td>
                            <td class="text-center">L/L</td>
                            <td class="text-center"><?php echo isset($referencia['hematocrito']) ? $referencia['hematocrito'] : 'N/A' ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <th colspan="3">DONADOR 1</th>
                        </thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" step="any" class="form-control" name="donador_1" value="<?php echo $pruebas['donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito_donador_1" value="<?php echo $pruebas['hematocrito_donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MACROSCÓPICA</th>
                            <th class="text-center">APARIENCIA</th>
                            <th class="text-center">AGREGADOS CELULARES</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_apariencia_donador_1" value="<?php echo $pruebas['prueba_mayor_apariencia_donador_1'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_agregados_celulares_donador_1" value="<?php echo $pruebas['prueba_mayor_agregados_celulares_donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_apariencia_donador_1" value="<?php echo $pruebas['prueba_menor_apariencia_donador_1'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_agregados_celulares_donador_1" value="<?php echo $pruebas['prueba_menor_agregados_celulares_donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MICROSCÓPICA</th>
                            <th class="text-center">AGLUTINACIÓN</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_aglutinacion_donador_1" value="<?php echo $pruebas['prueba_mayor_aglutinacion_donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_aglutinacion_donador_1" value="<?php echo $pruebas['prueba_menor_aglutinacion_donador_1'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="3">OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="text" step="any" class="form-control" name="observaciones_donador_1" value="<?php echo $pruebas['observaciones_donador_1'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <th colspan="3">DONADOR 2</th>
                        </thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" step="any" class="form-control" name="donador_2" value="<?php echo $pruebas['donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito_donador_2" value="<?php echo $pruebas['hematocrito_donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MACROSCÓPICA</th>
                            <th class="text-center">APARIENCIA</th>
                            <th class="text-center">AGREGADOS CELULARES</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_apariencia_donador_2" value="<?php echo $pruebas['prueba_mayor_apariencia_donador_2'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_agregados_celulares_donador_2" value="<?php echo $pruebas['prueba_mayor_agregados_celulares_donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_apariencia_donador_2" value="<?php echo $pruebas['prueba_menor_apariencia_donador_2'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_agregados_celulares_donador_2" value="<?php echo $pruebas['prueba_menor_agregados_celulares_donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MICROSCÓPICA</th>
                            <th class="text-center">AGLUTINACIÓN</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_aglutinacion_donador_2" value="<?php echo $pruebas['prueba_mayor_aglutinacion_donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_aglutinacion_donador_2" value="<?php echo $pruebas['prueba_menor_aglutinacion_donador_2'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="3">OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="text" step="any" class="form-control" name="observaciones_donador_2" value="<?php echo $pruebas['observaciones_donador_2'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <th colspan="3">DONADOR 3</th>
                        </thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" step="any" class="form-control" name="donador_3" value="<?php echo $pruebas['donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito_donador_3" value="<?php echo $pruebas['hematocrito_donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MACROSCÓPICA</th>
                            <th class="text-center">APARIENCIA</th>
                            <th class="text-center">AGREGADOS CELULARES</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_apariencia_donador_3" value="<?php echo $pruebas['prueba_mayor_apariencia_donador_3'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_agregados_celulares_donador_3" value="<?php echo $pruebas['prueba_mayor_agregados_celulares_donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_apariencia_donador_3" value="<?php echo $pruebas['prueba_menor_apariencia_donador_3'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_agregados_celulares_donador_3" value="<?php echo $pruebas['prueba_menor_agregados_celulares_donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MICROSCÓPICA</th>
                            <th class="text-center">AGLUTINACIÓN</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_aglutinacion_donador_3" value="<?php echo $pruebas['prueba_mayor_aglutinacion_donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_aglutinacion_donador_3" value="<?php echo $pruebas['prueba_menor_aglutinacion_donador_3'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="3">OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="text" step="any" class="form-control" name="observaciones_donador_3" value="<?php echo $pruebas['observaciones_donador_3'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <th colspan="3">DONADOR 4</th>
                        </thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" step="any" class="form-control" name="donador_4" value="<?php echo $pruebas['donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito_donador_4" value="<?php echo $pruebas['hematocrito_donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MACROSCÓPICA</th>
                            <th class="text-center">APARIENCIA</th>
                            <th class="text-center">AGREGADOS CELULARES</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_apariencia_donador_4" value="<?php echo $pruebas['prueba_mayor_apariencia_donador_4'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_agregados_celulares_donador_4" value="<?php echo $pruebas['prueba_mayor_agregados_celulares_donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_apariencia_donador_4" value="<?php echo $pruebas['prueba_menor_apariencia_donador_4'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_agregados_celulares_donador_4" value="<?php echo $pruebas['prueba_menor_agregados_celulares_donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MICROSCÓPICA</th>
                            <th class="text-center">AGLUTINACIÓN</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_aglutinacion_donador_4" value="<?php echo $pruebas['prueba_mayor_aglutinacion_donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_aglutinacion_donador_4" value="<?php echo $pruebas['prueba_menor_aglutinacion_donador_4'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="3">OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="text" step="any" class="form-control" name="observaciones_donador_4" value="<?php echo $pruebas['observaciones_donador_4'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <th colspan="3">DONADOR 5</th>
                        </thead>
                        <tr>
                            <td>NOMBRE</td>
                            <td><input type="text" step="any" class="form-control" name="donador_5" value="<?php echo $pruebas['donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito_donador_5" value="<?php echo $pruebas['hematocrito_donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MACROSCÓPICA</th>
                            <th class="text-center">APARIENCIA</th>
                            <th class="text-center">AGREGADOS CELULARES</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_apariencia_donador_5" value="<?php echo $pruebas['prueba_mayor_apariencia_donador_5'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_agregados_celulares_donador_5" value="<?php echo $pruebas['prueba_mayor_agregados_celulares_donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_apariencia_donador_5" value="<?php echo $pruebas['prueba_menor_apariencia_donador_5'] ?>"></td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_agregados_celulares_donador_5" value="<?php echo $pruebas['prueba_menor_agregados_celulares_donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <th>EVALUACIÓN MICROSCÓPICA</th>
                            <th class="text-center">AGLUTINACIÓN</th>
                        </tr>
                        <tr>
                            <td>PRUEBA MAYOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_mayor_aglutinacion_donador_5" value="<?php echo $pruebas['prueba_mayor_aglutinacion_donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA MENOR</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_menor_aglutinacion_donador_5" value="<?php echo $pruebas['prueba_menor_aglutinacion_donador_5'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="3">OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="text" step="any" class="form-control" name="observaciones_donador_5" value="<?php echo $pruebas['observaciones_donador_5'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $pruebas['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIONES</label>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar pruebas cruzadas</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>