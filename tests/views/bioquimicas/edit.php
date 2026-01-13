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
require_once '../../controllers/BioquimicaController.php';

$bioquimica = $bioquimica_controller->show($_GET['item_id']);
$item = $item_controller->show($bioquimica['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencia = $referencia_controller->show($bioquimica['fk_referencia_id']);
$bioquimica_controller->update($_GET['item_id']);

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
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $bioquimica['fecha'] ?>"></td>
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
                            <td>GLUCOSA</td>
                            <td><input type="number" step="any" class="form-control" name="glucosa" value="<?php echo $bioquimica['glucosa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['glucosa_calculada'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['glucosa']) ? $referencia['glucosa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>UREA</td>
                            <td><input type="number" step="any" class="form-control" name="urea" value="<?php echo $bioquimica['urea'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['urea'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['urea']) ? $referencia['urea'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>CREATININA</td>
                            <td><input type="number" step="any" class="form-control" name="creatinina" value="<?php echo $bioquimica['creatinina'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['creatinina_calculada'] ?></td>
                            <td class="text-center">μmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['creatinina']) ? $referencia['creatinina'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>COLESTEROL</td>
                            <td><input type="number" step="any" class="form-control" name="colesterol" value="<?php echo $bioquimica['colesterol'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['colesterol'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['colesterol']) ? $referencia['colesterol'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>TRIGLICÉRIDOS</td>
                            <td><input type="number" step="any" class="form-control" name="trigliceridos" value="<?php echo $bioquimica['trigliceridos'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['trigliceridos'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['trigliceridos']) ? $referencia['trigliceridos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA TOTAL</td>
                            <td><input type="number" step="any" class="form-control" name="bilirrubina_total" value="<?php echo $bioquimica['bilirrubina_total'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['bilirrubina_total_calculada'] > $bioquimica['bilirrubina_conjugada'] ? $bioquimica['bilirrubina_total_calculada'] : $bioquimica['bilirrubina_conjugada']; ?></td>
                            <td class="text-center">μmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['bilirrubina_total']) ? $referencia['bilirrubina_total'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA CONJUGADA</td>
                            <td><input type="number" step="any" class="form-control" name="bilirrubina_conjugada" value="<?php echo $bioquimica['bilirrubina_conjugada'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['bilirrubina_total_calculada'] < $bioquimica['bilirrubina_conjugada'] ? $bioquimica['bilirrubina_total_calculada'] : $bioquimica['bilirrubina_conjugada']; ?></td>
                            <td class="text-center">μmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['bilirrubina_conjugada']) ? $referencia['bilirrubina_conjugada'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA NO CONJUGADA</td>
                            <td><input disabled type="number" step="any" class="form-control" name="bilirrubina_no_conjugada"></td>
                            <td class="text-center"><?php echo $bioquimica['bilirrubina_no_conjugada_calculada'] ?></td>
                            <td class="text-center">μmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['bilirrubina_no_conjugada']) ? $referencia['bilirrubina_no_conjugada'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>ALANINA AMINOTRANSFERASA</td>
                            <td><input type="number" step="any" class="form-control" name="alanina_aminotransferasa" value="<?php echo $bioquimica['alanina_aminotransferasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['alanina_aminotransferasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['alanina_aminotransferasa']) ? $referencia['alanina_aminotransferasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>ASPARTATO AMINOTRANSFERASA</td>
                            <td><input type="number" step="any" class="form-control" name="aspartato_aminotransferasa" value="<?php echo $bioquimica['aspartato_aminotransferasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['aspartato_aminotransferasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['aspartato_aminotransferasa']) ? $referencia['aspartato_aminotransferasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>FOSFATASA ALCALINA</td>
                            <td><input type="number" step="any" class="form-control" name="fosfatasa_alcalina" value="<?php echo $bioquimica['fosfatasa_alcalina'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['fosfatasa_alcalina'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['fosfatasa_alcalina']) ? $referencia['fosfatasa_alcalina'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>AMILASA</td>
                            <td><input type="number" step="any" class="form-control" name="amilasa" value="<?php echo $bioquimica['amilasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['amilasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['amilasa']) ? $referencia['amilasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>LIPASA</td>
                            <td><input type="number" step="any" class="form-control" name="lipasa" value="<?php echo $bioquimica['lipasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['lipasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['lipasa']) ? $referencia['lipasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>CREATINACINASA</td>
                            <td><input type="number" step="any" class="form-control" name="creatinacinasa" value="<?php echo $bioquimica['creatinacinasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['creatinacinasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['creatinacinasa']) ? $referencia['creatinacinasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>GLUTAMATO DESHIDROGENASA</td>
                            <td><input type="number" step="any" class="form-control" name="glutamato_deshidrogenasa" value="<?php echo $bioquimica['glutamato_deshidrogenasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['glutamato_deshidrogenasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['glutamato_deshidrogenasa']) ? $referencia['glutamato_deshidrogenasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>GAMAGLUTAMIL TRANSFERASA</td>
                            <td><input type="number" step="any" class="form-control" name="gamaglutamil_transferasa" value="<?php echo $bioquimica['gamaglutamil_transferasa'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['gamaglutamil_transferasa'] ?></td>
                            <td class="text-center">U/L</td>
                            <td class="text-center"><?php echo isset($referencia['gamaglutamil_transferasa']) ? $referencia['gamaglutamil_transferasa'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>PROTEINAS TOTALES</td>
                            <td><input type="number" step="any" class="form-control" name="proteinas_totales" value="<?php echo $bioquimica['proteinas_totales'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['proteinas_totales'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['proteinas_totales']) ? $referencia['proteinas_totales'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>ALBÚMINA</td>
                            <td><input type="number" step="any" class="form-control" name="albumina" value="<?php echo $bioquimica['albumina'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['albumina'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['albumina']) ? $referencia['albumina'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>GLOBULINAS</td>
                            <td><input disabled type="number" step="any" class="form-control" name="globulinas"></td>
                            <td class="text-center"><?php echo $bioquimica['globulinas_calculadas'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['globulinas']) ? $referencia['globulinas'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN A/G</td>
                            <td><input disabled type="number" step="any" class="form-control" name="relacion_ag"></td>
                            <td class="text-center"><?php echo $bioquimica['relacion_ag_calculada'] ?></td>
                            <td class="text-center">-</td>
                            <td class="text-center"><?php echo isset($referencia['relacion_ag']) ? $referencia['relacion_ag'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>CALCIO</td>
                            <td><input type="number" step="any" class="form-control" name="calcio" value="<?php echo $bioquimica['calcio'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['calcio_calculado'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['calcio']) ? $referencia['calcio'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>FOSFORO</td>
                            <td><input type="number" step="any" class="form-control" name="fosforo" value="<?php echo $bioquimica['fosforo'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['fosforo_calculada'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['fosforo']) ? $referencia['fosforo'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>POTASIO</td>
                            <td><input type="number" step="any" class="form-control" name="potasio" value="<?php echo $bioquimica['potasio'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['potasio'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['potasio']) ? $referencia['potasio'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>SODIO</td>
                            <td><input type="number" step="any" class="form-control" name="sodio" value="<?php echo $bioquimica['sodio'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['sodio'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['sodio']) ? $referencia['sodio'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN Na/K</td>
                            <td><input disabled type="number" step="any" class="form-control" name="relacion_nak_calculada"></td>
                            <td class="text-center"><?php echo $bioquimica['relacion_nak_calculada'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['relacion_nak']) ? $referencia['relacion_nak'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>CLORO</td>
                            <td><input type="number" step="any" class="form-control" name="cloro" value="<?php echo $bioquimica['cloro'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['cloro'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['cloro']) ? $referencia['cloro'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BICARBONATO</td>
                            <td><input type="number" step="any" class="form-control" name="bicarbonato" value="<?php echo $bioquimica['bicarbonato'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['bicarbonato'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['bicarbonato']) ? $referencia['bicarbonato'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>ANION GAP</td>
                            <td><input disabled type="number" step="any" class="form-control" name="brecha_anionica"></td>
                            <td class="text-center"><?php echo $bioquimica['brecha_anionica_calculada'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['brecha_anionica']) ? $referencia['brecha_anionica'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>DIFERENCIA DE IONES FUERTES</td>
                            <td><input disabled type="number" step="any" class="form-control" name="diferencia_de_iones_fuertes"></td>
                            <td class="text-center"><?php echo $bioquimica['diferencia_de_iones_fuertes_calculada'] ?></td>
                            <td class="text-center">mmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['diferencia_de_iones_fuertes']) ? $referencia['diferencia_de_iones_fuertes'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>OSMOLALIDAD</td>
                            <td><input disabled type="number" step="any" class="form-control" name="osmolalidad"></td>
                            <td class="text-center"><?php echo $bioquimica['osmolalidad_calculada'] ?></td>
                            <td class="text-center">mOsml/Kg</td>
                            <td class="text-center"><?php echo isset($referencia['osmolalidad']) ? $referencia['osmolalidad'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>AMONIO</td>
                            <td><input type="number" step="any" class="form-control" name="amonio" value="<?php echo $bioquimica['amonio'] ?>"></td>
                            <td class="text-center"><?php echo $bioquimica['amonio'] ?></td>
                            <td class="text-center">μmol/L</td>
                            <td class="text-center"><?php echo isset($referencia['amonio']) ? $referencia['amonio'] : 'N/A' ?></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="observaciones"><?php echo $bioquimica['observaciones'] ?></textarea>
                    <label>OBSERVACIONES</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $bioquimica['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIONES</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar bioquímica</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>