<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/UrianalisisController.php';

$urianalisis = $urianalisis_controller->show($_GET['item_id']);
$item = $item_controller->show($urianalisis['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$urianalisis_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $urianalisis['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select class="form-select" name="metodo_de_obtencion" required>
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="MICCIÓN" <?php echo (($urianalisis['metodo_de_obtencion'] === "MICCIÓN") ? "selected" : "")  ?>>MICCIÓN</option>
                        <option value="CATETERISMO" <?php echo (($urianalisis['metodo_de_obtencion'] === "CATETERISMO") ? "selected" : "")  ?>>CATETERISMO</option>
                        <option value="CISTOCENTESIS" <?php echo (($urianalisis['metodo_de_obtencion'] === "CISTOCENTESIS") ? "selected" : "")  ?>>CISTOCENTESIS</option>
                    </select>
                    <label>MÉTODO DE OBTENCIÓN</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>EXAMEN FÍSICO</th>
                                <th>RESULTADO</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>APARIENCIA</td>
                            <td><input type="text" step="any" class="form-control" name="apariencia" value="<?php echo $urianalisis['apariencia'] ?>"></td>
                        </tr>
                        <tr>
                            <td>COLOR</td>
                            <td><input type="text" step="any" class="form-control" name="color" value="<?php echo $urianalisis['color'] ?>"></td>
                        </tr>
                        <tr>
                            <td>DENSIDAD</td>
                            <td><input type="text" step="any" class="form-control" name="densidad" value="<?php echo $urianalisis['densidad'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="2">EXAMEN QUÍMICO</th>
                        </tr>
                        <tr>
                            <td>pH</td>
                            <td><input type="text" step="any" class="form-control" name="ph" value="<?php echo $urianalisis['ph'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PROTEÍNAS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="proteinas" value="<?php echo $urianalisis['proteinas'] ?>">
                                    <span class="input-group-text">g/L</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>GLUCOSA</td>
                            <td><input type="text" step="any" class="form-control" name="glucosa" value="<?php echo $urianalisis['glucosa'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CETONAS</td>
                            <td><input type="text" step="any" class="form-control" name="cetonas" value="<?php echo $urianalisis['cetonas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA</td>
                            <td><input type="text" step="any" class="form-control" name="bilirrubina" value="<?php echo $urianalisis['bilirrubina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMOGLOBINA / SANGRE</td>
                            <td><input type="text" step="any" class="form-control" name="hemoglobina" value="<?php echo $urianalisis['hemoglobina'] ?>"></td>
                        </tr>
                        <tr>
                            <th colspan="2">EXAMEN MICROSCÓPICO</th>
                        </tr>
                        <tr>
                            <td>ERITROCITOS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="eritrocitos" value="<?php echo $urianalisis['eritrocitos'] ?>">
                                    <span class="input-group-text">/CAMPO (400X)</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>LEUCOCITOS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="leucocitos" value="<?php echo $urianalisis['leucocitos'] ?>">
                                    <span class="input-group-text">/CAMPO (400X)</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CÉLULAS EPITELIALES TRANSITORIAS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="celulas_epiteliales_transitorias" value="<?php echo $urianalisis['celulas_epiteliales_transitorias'] ?>">
                                    <span class="input-group-text">/CAMPO (400X)</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CÉLULAS EPITELIALES ESCAMOSAS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="celulas_epiteliales_escamosas" value="<?php echo $urianalisis['celulas_epiteliales_escamosas'] ?>">
                                    <span class="input-group-text">/CAMPO (400X)</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>CILINDROS</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" name="cilindros" value="<?php echo $urianalisis['cilindros'] ?>">
                                    <span class="input-group-text">/CAMPO (400X)</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TIPO</td>
                            <td><input type="text" step="any" class="form-control" name="tipo" value="<?php echo $urianalisis['tipo'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CRISTALES</td>
                            <td><input type="text" step="any" class="form-control" name="cristales" value="<?php echo $urianalisis['cristales'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BACTERIAS</td>
                            <td><input type="text" step="any" class="form-control" name="bacterias" value="<?php echo $urianalisis['bacterias'] ?>"></td>
                        </tr>
                        <tr>
                            <td>LÍPIDOS</td>
                            <td><input type="text" step="any" class="form-control" name="lipidos" value="<?php echo $urianalisis['lipidos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>OTROS</td>
                            <td><input type="text" step="any" class="form-control" name="otros" value="<?php echo $urianalisis['otros'] ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $urianalisis['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIÓN</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar urianálisis</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>