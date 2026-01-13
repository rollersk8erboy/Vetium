<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/LiquidosController.php';

$liquidos = $liquidos_controller->show($_GET['item_id']);
$item = $item_controller->show($liquidos['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$liquidos_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3 mt-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $liquidos['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="tipo_de_liquido"><?php echo $liquidos['tipo_de_liquido'] ?></textarea>
                    <label>TIPO DE LÍQUIDO</label>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>EXAMEN FÍSICO-QUÍMICO</th>
                                <th>RESULTADO</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>APARIENCIA</td>
                            <td><input type="text" step="any" class="form-control" name="apariencia" value="<?php echo $liquidos['apariencia'] ?>"></td>
                        </tr>
                        <tr>
                            <td>COLOR</td>
                            <td><input type="text" step="any" class="form-control" name="color" value="<?php echo $liquidos['color'] ?>"></td>
                        </tr>
                        <tr>
                            <td>HEMATOCRITO</td>
                            <td><input type="text" step="any" class="form-control" name="hematocrito" value="<?php echo $liquidos['hematocrito'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CREATININA</td>
                            <td><input type="text" step="any" class="form-control" name="creatinina" value="<?php echo $liquidos['creatinina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>COLESTEROL</td>
                            <td><input type="text" step="any" class="form-control" name="colesterol" value="<?php echo $liquidos['colesterol'] ?>"></td>
                        </tr>
                        <tr>
                            <td>TRIGLICERIDOS</td>
                            <td><input type="text" step="any" class="form-control" name="trigliceridos" value="<?php echo $liquidos['trigliceridos'] ?>"></td>
                        </tr>
                        <tr>
                            <td>BILIRRUBINA</td>
                            <td><input type="text" step="any" class="form-control" name="bilirrubina" value="<?php echo $liquidos['bilirrubina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>CONTEO CELULAR</td>
                            <td><input type="text" step="any" class="form-control" name="conteo_celular" value="<?php echo $liquidos['conteo_celular'] ?>"></td>
                        </tr>
                        <tr>
                            <td>VISCOCIDAD</td>
                            <td><input type="text" step="any" class="form-control" name="viscocidad" value="<?php echo $liquidos['viscocidad'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA DE MUCINA</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_de_mucina" value="<?php echo $liquidos['prueba_de_mucina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PRUEBA DE PANDY</td>
                            <td><input type="text" step="any" class="form-control" name="prueba_de_pandy" value="<?php echo $liquidos['prueba_de_pandy'] ?>"></td>
                        </tr>
                        <tr>
                            <td>PROTEÍNAS</td>
                            <td><input type="text" step="any" class="form-control" name="proteinas" value="<?php echo $liquidos['proteinas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ALBÚMINA</td>
                            <td><input type="text" step="any" class="form-control" name="albumina" value="<?php echo $liquidos['albumina'] ?>"></td>
                        </tr>
                        <tr>
                            <td>GLOBULINAS</td>
                            <td><input type="text" step="any" class="form-control" name="globulinas" value=""></td>
                        </tr>
                        <tr>
                            <td>RELACIÓN A/G</td>
                            <td><input type="text" step="any" class="form-control" name="relacion_ag" value=""></td>
                        </tr>
                    </table>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="descripcion_microscopica"><?php echo $liquidos['descripcion_microscopica'] ?></textarea>
                    <label>DESCRIPCIÓN MICROSCÓPICA</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="interpretaciones"><?php echo $liquidos['interpretaciones'] ?></textarea>
                    <label>INTERPRETACIÓN</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="diagnostico"><?php echo $liquidos['diagnostico'] ?></textarea>
                    <label>DIAGNÓSTICO</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="comentario"><?php echo $liquidos['comentario'] ?></textarea>
                    <label>COMENTARIO</label>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar análisis de líquidos</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>