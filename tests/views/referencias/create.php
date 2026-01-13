<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/SpecieController.php';
require_once '../../controllers/ReferenciaController.php';
$referencia_controller->store();
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <select class="form-select" name="fk_specie_id" required>
                        <?php require_once '../../../views/species/options.php'; ?>
                    </select>
                    <label>Especie</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="rollersk8erboy" name="descripcion" required>
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
                            <td><input type="text" class="form-control" name="hematocrito" value=""></td>
                        </tr>
                        <tr>
                            <td>ERITROCITOS</td>
                            <td class="text-center">x10<sup>12</sup>L</td>
                            <td><input type="text" class="form-control" name="eritrocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>HEMOGLOBINA</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="hemoglobina" value=""></td>
                        </tr>
                        <tr>
                            <td>VGM</td>
                            <td class="text-center">fL</td>
                            <td><input type="text" class="form-control" name="vgm" value=""></td>
                        </tr>
                        <tr>
                            <td>CGMH</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="cgmh" value=""></td>
                        </tr>
                        <tr>
                            <td>RETICULOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="reticulocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>PLAQUETAS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="plaquetas" value=""></td>
                        </tr>
                        <tr>
                            <td>SOLIDOS TOTALES</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="solidos_totales" value=""></td>
                        </tr>
                        <tr>
                            <td>FIBRINOGENO</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="fibrinogeno" value=""></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN PT/FIB</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="relacion_ptfib" value=""></td>
                        </tr>
                        <tr>
                            <td>LEUCOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="leucocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>NEUTRÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="neutrofilos" value=""></td>
                        </tr>
                        <tr>
                            <td>BANDAS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="bandas" value=""></td>
                        </tr>
                        <tr>
                            <td>METAMIELOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="metamielocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>MIELOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="mielocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>LINFOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="linfocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>MONOCITOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="monocitos" value=""></td>
                        </tr>
                        <tr>
                            <td>EOSINÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="eosinofilos" value=""></td>
                        </tr>
                        <tr>
                            <td>BASÓFILOS</td>
                            <td class="text-center">x10<sup>9</sup>L</td>
                            <td><input type="text" class="form-control" name="basofilos" value=""></td>
                        </tr>
                        <tr>
                            <td>GLUCOSA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="glucosa" value=""></td>
                        </tr>
                        <tr>
                            <td>UREA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="urea" value=""></td>
                        </tr>
                        <tr>
                            <td>CREATININA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="creatinina" value=""></td>
                        </tr>
                        <tr>
                            <td>COLESTEROL</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="colesterol" value=""></td>
                        </tr>
                        <tr>
                            <td>TRIGLICÉRIDOS</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="trigliceridos" value=""></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA TOTAL</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_total" value=""></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA CONJUGADA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_conjugada" value=""></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA NO CONJUGADA</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="bilirrubina_no_conjugada" value=""></td>
                        </tr>
                        <tr>
                            <td>ALANINA AMINOTRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="alanina_aminotransferasa" value=""></td>
                        </tr>
                        <tr>
                            <td>ASPARTATO AMINOTRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="aspartato_aminotransferasa" value=""></td>
                        </tr>
                        <tr>
                            <td>FOSFATASA ALCALINA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="fosfatasa_alcalina" value=""></td>
                        </tr>
                        <tr>
                            <td>AMILASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="amilasa" value=""></td>
                        </tr>
                        <tr>
                            <td>LIPASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="lipasa" value=""></td>
                        </tr>
                        <tr>
                            <td>CREATINACINASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="creatinacinasa" value=""></td>
                        </tr>
                        <tr>
                            <td>GLUTAMATO DESHIDROGENASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="glutamato_deshidrogenasa" value=""></td>
                        </tr>
                        <tr>
                            <td>GAMAGLUTAMIL TRANSFERASA</td>
                            <td class="text-center">U/L</td>
                            <td><input type="text" class="form-control" name="gamaglutamil_transferasa" value=""></td>
                        </tr>
                        <tr>
                            <td>PROTEINAS TOTALES</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="proteinas_totales" value=""></td>
                        </tr>
                        <tr>
                            <td>ALBÚMINA</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="albumina" value=""></td>
                        </tr>
                        <tr>
                            <td>GLOBULINAS</td>
                            <td class="text-center">g/L</td>
                            <td><input type="text" class="form-control" name="globulinas" value=""></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN ALBÚMINA-GLOBULINAS</td>
                            <td class="text-center">-</td>
                            <td><input type="text" class="form-control" name="relacion_ag" value=""></td>
                        </tr>
                        <tr>
                            <td>CALCIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="calcio" value=""></td>
                        </tr>
                        <tr>
                            <td>FOSFORO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="fosforo" value=""></td>
                        </tr>
                        <tr>
                            <td>POTASIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="potasio" value=""></td>
                        </tr>
                        <tr>
                            <td>SODIO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="sodio" value=""></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN Na/K</td>
                            <td class="text-center">-</td>
                            <td><input type="text" class="form-control" name="relacion_nak" value=""></td>
                        </tr>
                        <tr>
                            <td>CLORO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="cloro" value=""></td>
                        </tr>
                        <tr>
                            <td>BICARBONATO</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="bicarbonato" value=""></td>
                        </tr>
                        <tr>
                            <td>BRECHA ANIÓNICA</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="brecha_anionica" value=""></td>
                        </tr>
                        <tr>
                            <td>DIFERENCIA DE IONES FUERTES</td>
                            <td class="text-center">mmol/L</td>
                            <td><input type="text" class="form-control" name="diferencia_de_iones_fuertes" value=""></td>
                        </tr>
                        <tr>
                            <td>OSMOLALIDAD</td>
                            <td class="text-center">mOsml/Kg</td>
                            <td><input type="text" class="form-control" name="osmolalidad" value=""></td>
                        </tr>
                        <tr>
                            <td>AMONIO</td>
                            <td class="text-center">μmol/L</td>
                            <td><input type="text" class="form-control" name="amonio" value=""></td>
                        </tr>
                        <tr>
                            <td>TIEMPO DE TROMBOPLASTINA</td>
                            <td class="text-center">s</td>
                            <td><input type="text" class="form-control" name="tiempo_de_tromboplastina" value=""></td>
                        </tr>
                        <tr>
                            <td>TIEMPO DE PROTOMBINA</td>
                            <td class="text-center">s</td>
                            <td><input type="text" class="form-control" name="tiempo_de_protrombina" value=""></td>
                        </tr>
                        <tr>
                            <td>T4 LIBRE</td>
                            <td class="text-center">pmol/L</td>
                            <td><input type="text" class="form-control" name="t4_libre" value=""></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar referencia</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>