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
require_once '../../controllers/HemogramaController.php';

$hemograma = $hemograma_controller->show($_GET['item_id']);
$item = $item_controller->show($hemograma['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencia = $referencia_controller->show($hemograma['fk_referencia_id']);
$hemograma_controller->update($_GET['item_id']);
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
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $hemograma['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
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
                            <td><input type="number" step="any" class="form-control" name="hematocrito" value="<?php echo $hemograma['hematocrito'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['hematocrito'] ?></td>
                            <td class="text-center">L/L</td>
                            <td class="text-center"><?php echo isset($referencia['hematocrito']) ? $referencia['hematocrito'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>ERITROCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="eritrocitos" value="<?php echo $hemograma['eritrocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['eritrocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>12</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['eritrocitos']) ? $referencia['eritrocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>HEMOGLOBINA</td>
                            <td><input type="number" step="any" class="form-control" name="hemoglobina" value="<?php echo $hemograma['hemoglobina'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['hemoglobina'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['hemoglobina']) ? $referencia['hemoglobina'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>VGM</td>
                            <td><input disabled type="number" step="any" class="form-control" name="vgm"></td>
                            <td class="text-center"><?php echo $hemograma['vgm_calculada'] ?></td>
                            <td class="text-center">fL</td>
                            <td class="text-center"><?php echo isset($referencia['vgm']) ? $referencia['vgm'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>CGMH</td>
                            <td><input disabled type="number" step="any" class="form-control" name="cgmh"></td>
                            <td class="text-center"><?php echo $hemograma['cgmh_calculada'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['cgmh']) ? $referencia['cgmh'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>RETICULOCITOS</td>
                            <td>
                                <input type="number" step="any" class="form-control me-3" name="reticulocitos" value="<?php echo $hemograma['reticulocitos'] ?>">
                                <div class="d-flex mt-2">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_1" value="<?php echo $hemograma['reticulocito_1'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_2" value="<?php echo $hemograma['reticulocito_2'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_3" value="<?php echo $hemograma['reticulocito_3'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_4" value="<?php echo $hemograma['reticulocito_4'] ?>">
                                    <input type="number" step="any" class="form-control" name="reticulocito_5" value="<?php echo $hemograma['reticulocito_5'] ?>">
                                </div>
                                <div class="d-flex mt-2">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_6" value="<?php echo $hemograma['reticulocito_6'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_7" value="<?php echo $hemograma['reticulocito_7'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_8" value="<?php echo $hemograma['reticulocito_8'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="reticulocito_9" value="<?php echo $hemograma['reticulocito_9'] ?>">
                                    <input type="number" step="any" class="form-control" name="reticulocito_10" value="<?php echo $hemograma['reticulocito_10'] ?>">
                                </div>
                            </td>
                            <td class="text-center"><?php echo $hemograma['reticulocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['reticulocitos']) ? $referencia['reticulocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>PLAQUETAS</td>
                            <td>
                                <div class="d-flex">
                                    <input type="number" step="any" class="form-control me-3" name="plaqueta_1" value="<?php echo $hemograma['plaqueta_1'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="plaqueta_2" value="<?php echo $hemograma['plaqueta_2'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="plaqueta_3" value="<?php echo $hemograma['plaqueta_3'] ?>">
                                    <input type="number" step="any" class="form-control me-3" name="plaqueta_4" value="<?php echo $hemograma['plaqueta_4'] ?>">
                                    <input type="number" step="any" class="form-control" name="plaqueta_5" value="<?php echo $hemograma['plaqueta_5'] ?>">
                                </div>
                            </td>
                            <td class="text-center"><?php echo $hemograma['plaquetas_calculadas'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['plaquetas']) ? $referencia['plaquetas'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>SÓLIDOS TOTALES</td>
                            <td><input type="number" step="any" class="form-control" name="solidos_totales" value="<?php echo $hemograma['solidos_totales'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['solidos_totales'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['solidos_totales']) ? $referencia['solidos_totales'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>FIBRINÓGENO</td>
                            <td>
                                <div class="d-flex">
                                    <input type="number" step="any" class="form-control me-3" name="proteina_1" value="<?php echo $hemograma['proteina_1'] ?>">
                                    <input type="number" step="any" class="form-control" name="proteina_2" value="<?php echo $hemograma['proteina_2'] ?>">
                                </div>
                            </td>
                            <td class="text-center"><?php echo $hemograma['fibrinogeno_calculado'] ?></td>
                            <td class="text-center">g/L</td>
                            <td class="text-center"><?php echo isset($referencia['fibrinogeno']) ? $referencia['fibrinogeno'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN PT/FIB</td>
                            <td><input disabled type="number" step="any" class="form-control" name="relacion_ptfib"></td>
                            <td class="text-center"><?php echo $hemograma['relacion_ptfib_calculada'] ?></td>
                            <td class="text-center">-</td>
                            <td class="text-center"><?php echo isset($referencia['relacion_ptfib']) ? $referencia['relacion_ptfib'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>LEUCOCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="leucocitos" value="<?php echo $hemograma['leucocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['leucocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['leucocitos']) ? $referencia['leucocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <th colspan="5">DIFERENCIAL</th>
                        </tr>
                        <tr>
                            <td>NEUTRÓFILOS</td>
                            <td><input type="number" step="any" class="form-control" name="neutrofilos" value="<?php echo $hemograma['neutrofilos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['neutrofilos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['neutrofilos']) ? $referencia['neutrofilos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BANDAS</td>
                            <td><input type="number" step="any" class="form-control" name="bandas" value="<?php echo $hemograma['bandas'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['bandas_calculadas'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['bandas']) ? $referencia['bandas'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>METAMIELOCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="metamielocitos" value="<?php echo $hemograma['metamielocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['metamielocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['metamielocitos']) ? $referencia['metamielocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>MIELOCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="mielocitos" value="<?php echo $hemograma['mielocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['mielocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['mielocitos']) ? $referencia['mielocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>LINFOCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="linfocitos" value="<?php echo $hemograma['linfocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['linfocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['linfocitos']) ? $referencia['linfocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>MONOCITOS</td>
                            <td><input type="number" step="any" class="form-control" name="monocitos" value="<?php echo $hemograma['monocitos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['monocitos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['monocitos']) ? $referencia['monocitos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>EOSINÓFILOS</td>
                            <td><input type="number" step="any" class="form-control" name="eosinofilos" value="<?php echo $hemograma['eosinofilos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['eosinofilos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['eosinofilos']) ? $referencia['eosinofilos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td>BASÓFILOS</td>
                            <td><input type="number" step="any" class="form-control" name="basofilos" value="<?php echo $hemograma['basofilos'] ?>"></td>
                            <td class="text-center"><?php echo $hemograma['basofilos_calculados'] ?></td>
                            <td class="text-center">x10<sup>9</sup>/L</td>
                            <td class="text-center"><?php echo isset($referencia['basofilos']) ? $referencia['basofilos'] : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">MORFOLOGÍA DE ERITROCITOS</th>
                        </tr>
                        <tr>
                            <td>ANISOCITOSIS</td>
                            <td><input type="text" step="any" class="form-control" name="anisocitosis" value="<?php echo $hemograma['anisocitosis'] ?>"></td>
                        </tr>
                        <tr>
                            <td>POLICROMASIA</td>
                            <td><input type="text" step="any" class="form-control" name="policromasia" value="<?php echo $hemograma['policromasia'] ?>"></td>
                        </tr>
                        <tr>
                            <td>AGLUTINACIÓN</td>
                            <td><input type="text" step="any" class="form-control" name="aglutinacion" value="<?php echo $hemograma['aglutinacion'] ?>"></td>
                        </tr>
                        <tr>
                            <td>POIQUILOCITOS</td>
                            <td><input type="text" step="any" class="form-control" name="poiquilocitos" value="<?php echo $hemograma['poiquilocitos'] ?>"></td>
                        </tr>

                        <th colspan="2">MORFOLOGÍA DE LEUCOCITOS</th>
                        <tr>
                            <td>NEUTRÓFILOS TÓXICOS</td>
                            <td><input type="text" step="any" class="form-control" name="neutrofilos_toxicos" value="<?php echo $hemograma['neutrofilos_toxicos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>LINFOCITOS REACTIVOS</td>
                            <td><input type="text" step="any" class="form-control" name="linfocitos_reactivos" value="<?php echo $hemograma['linfocitos_reactivos'] ?>"></td>
                        </tr>
                        <th colspan="2">OTROS HALLAZGOS</th>
                        <tr>
                            <td>HALLAZGOS</td>
                            <td><input type="text" step="any" class="form-control" name="otros_hallazgos" value="<?php echo $hemograma['otros_hallazgos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ERITROCITOS NUCLEADOS</td>
                            <td><input type="number" step="any" class="form-control" name="eritrocitos_nucleados" value="<?php echo $hemograma['eritrocitos_nucleados'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="observaciones"><?php echo $hemograma['observaciones'] ?></textarea>
                    <label>OBSERVACIONES</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $hemograma['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIONES</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar hemograma</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>