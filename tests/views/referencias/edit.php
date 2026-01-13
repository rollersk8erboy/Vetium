<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/SpecieController.php';
require_once '../../controllers/ReferenciaController.php';
$reference = $referencia_controller->show($_GET['referencia_id']);
$specie = $specie_controller->show($reference['fk_specie_id']);
$referencia_controller->update($_GET['referencia_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <select class="form-select" name="fk_specie_id" required>
                        <?php require_once '../../../views/species/options.php'; ?>
                    </select>
                    <label>Especie</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="descripcion" value="<?php echo $reference['descripcion'] ?>">
                    <label>Descripción</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ANALITO</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">VALORES DE REFERENCIA</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td class="text-center">L/L</td>
                            <td><input type="text" class="form-control" name="hematocrito" value="<?php echo $reference['hematocrito'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ERITROCITOS</td>
                            <td class="text-center">x10<sup>12</sup>L</td>
                            <td><input type="text" class="form-control" name="eritrocitos" value="<?php echo $reference['eritrocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMOGLOBINA</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="hemoglobina" value="<?php echo $reference['hemoglobina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>VGM</td>
                            <td class="text-center">fL</td>
                            <td><input type="text" class="form-control" name="vgm" value="<?php echo $reference['vgm'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CGMH</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="cgmh" value="<?php echo $reference['cgmh'] ?>"></td>
                        </tr>
                        <tr>
                            <td>RETICULOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="reticulocitos" value="<?php echo $reference['reticulocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PLAQUETAS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="plaquetas" value="<?php echo $reference['plaquetas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>SOLIDOS TOTALES</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="solidos_totales" value="<?php echo $reference['solidos_totales'] ?>"></td>
                        </tr>
                        <tr>
                            <td>FIBRINOGENO</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="fibrinogeno" value="<?php echo $reference['fibrinogeno'] ?>"></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN PT/FIB</td>
                            <td class="text-center">-</td>
                            <td><input type="text" class="form-control" name="relacion_ptfib" value="<?php echo $reference['relacion_ptfib'] ?>"></td>
                        </tr>
                        <tr>
                            <td>LEUCOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="leucocitos" value="<?php echo $reference['leucocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>NEUTRÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="neutrofilos" value="<?php echo $reference['neutrofilos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BANDAS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="bandas" value="<?php echo $reference['bandas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>METAMIELOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="metamielocitos" value="<?php echo $reference['metamielocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>MIELOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="mielocitos" value="<?php echo $reference['mielocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>LINFOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="linfocitos" value="<?php echo $reference['linfocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>MONOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="monocitos" value="<?php echo $reference['monocitos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>EOSINÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="eosinofilos" value="<?php echo $reference['eosinofilos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BASÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="basofilos" value="<?php echo $reference['basofilos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>GLUCOSA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="glucosa" value="<?php echo $reference['glucosa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>UREA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="urea" value="<?php echo $reference['urea'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CREATININA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="creatinina" value="<?php echo $reference['creatinina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>COLESTEROL</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="colesterol" value="<?php echo $reference['colesterol'] ?>"></td>
                        </tr>
                        <tr>
                            <td>TRIGLICÉRIDOS</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="trigliceridos" value="<?php echo $reference['trigliceridos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA TOTAL</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_total" value="<?php echo $reference['bilirrubina_total'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA CONJUGADA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_conjugada" value="<?php echo $reference['bilirrubina_conjugada'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA NO CONJUGADA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_no_conjugada" value="<?php echo $reference['bilirrubina_no_conjugada'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ALANINA AMINOTRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="alanina_aminotransferasa" value="<?php echo $reference['alanina_aminotransferasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ASPARTATO AMINOTRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="aspartato_aminotransferasa" value="<?php echo $reference['aspartato_aminotransferasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>FOSFATASA ALCALINA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="fosfatasa_alcalina" value="<?php echo $reference['fosfatasa_alcalina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>AMILASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="amilasa" value="<?php echo $reference['amilasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>LIPASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="lipasa" value="<?php echo $reference['lipasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CREATINACINASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="creatinacinasa" value="<?php echo $reference['creatinacinasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>GLUTAMATO DESHIDROGENASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="glutamato_deshidrogenasa" value="<?php echo $reference['glutamato_deshidrogenasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>GAMAGLUTAMIL TRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="gamaglutamil_transferasa" value="<?php echo $reference['gamaglutamil_transferasa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PROTEINAS TOTALES</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="proteinas_totales" value="<?php echo $reference['proteinas_totales'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ALBÚMINA</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="albumina" value="<?php echo $reference['albumina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>GLOBULINAS</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="globulinas" value="<?php echo $reference['globulinas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN A/G</td>
                            <td class="text-center">-</td>
                            <td><input type="text" class="form-control" name="relacion_ag" value="<?php echo $reference['relacion_ag'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CALCIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="calcio" value="<?php echo $reference['calcio'] ?>"></td>
                        </tr>
                        <tr>
                            <td>FOSFORO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="fosforo" value="<?php echo $reference['fosforo'] ?>"></td>
                        </tr>
                        <tr>
                            <td>POTASIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="potasio" value="<?php echo $reference['potasio'] ?>"></td>
                        </tr>
                        <tr>
                            <td>SODIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="sodio" value="<?php echo $reference['sodio'] ?>"></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN Na/K</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="relacion_nak" value="<?php echo $reference['relacion_nak'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CLORO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="cloro" value="<?php echo $reference['cloro'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BICARBONATO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="bicarbonato" value="<?php echo $reference['bicarbonato'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BRECHA ANIÓNICA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="brecha_anionica" value="<?php echo $reference['brecha_anionica'] ?>"></td>
                        </tr>
                        <tr>
                            <td>DIFERENCIA DE IONES FUERTES</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="diferencia_de_iones_fuertes" value="<?php echo $reference['diferencia_de_iones_fuertes'] ?>"></td>
                        </tr>
                        <tr>
                            <td>OSMOLALIDAD</td>
                            <td class="text-center">mOsml/Kg</td>
                            <td><input type="text" class="form-control" name="osmolalidad" value="<?php echo $reference['osmolalidad'] ?>"></td>
                        </tr>
                        <tr>
                            <td>AMONIO</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="amonio" value="<?php echo $reference['amonio'] ?>"></td>
                        </tr>
                        <tr>
                            <td>TIEMPO DE TROMBOPLASTINA</td>
                            <td class="text-center">s</td>
                            <td><input type="text" class="form-control" name="tiempo_de_tromboplastina" value="<?php echo $reference['tiempo_de_tromboplastina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>TIEMPO DE PROTOMBINA</td>
                            <td class="text-center">s</td>
                            <td><input type="text" class="form-control" name="tiempo_de_protrombina" value="<?php echo $reference['tiempo_de_protrombina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>T4 LIBRE</td>
                            <td class="text-center">pmol/L</td>
                            <td><input type="text" class="form-control" name="t4_libre" value="<?php echo $reference['t4_libre'] ?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar referencia</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>