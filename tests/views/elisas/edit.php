<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../../templates/head.php';
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../controllers/ElisaController.php';

$elisa = $elisa_controller->show($_GET['item_id']);
$item = $item_controller->show($elisa['fk_item_id']);
$case = $case_controller->show($item['fk_case_id']);
$elisa_controller->update($_GET['item_id']);
?>

<body>
    <?php require_once '../../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <textarea oninput="resizeArea(this)" class="form-control" name="observaciones"><?php echo $elisa['observaciones'] ?></textarea>
                    <label>OBSERVACIONES</label>
                </div>
                <div class="form-floating mb-3">
                    <td><input type="date" step="any" class="form-control" name="fecha" value="<?php echo $elisa['fecha'] ?>"></td>
                    <label>FECHA DE OBTENCIÓN DE MUESTRA</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ac_anaplasma">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ac_anaplasma'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ac_anaplasma'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AC ANAPLASMA</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ac_borrelia_burgdorferi">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ac_borrelia_burgdorferi'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ac_borrelia_burgdorferi'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AC BORRELIA BURGDORFERI</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ac_ehrlichia_canis">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ac_ehrlichia_canis'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ac_ehrlichia_canis'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AC EHRLICHIA CANIS</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ac_vif">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ac_vif'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ac_vif'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AC VIF</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ag_dirofilaria_immitis">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ag_dirofilaria_immitis'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ag_dirofilaria_immitis'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AG DIROFILARIA IMMITIS</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ag_filaria">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ag_filaria'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ag_filaria'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AG FILARIA</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ag_distemper_canino">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ag_distemper_canino'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ag_distemper_canino'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AG DISTEMPER CANINO</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ag_levf">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ag_levf'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ag_levf'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AG LEVF</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="ag_parvovirus">
                        <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                        <option value="POSITIVO" <?php echo (($elisa['ag_parvovirus'] === "POSITIVO") ? "selected" : "")  ?>>POSITIVO</option>
                        <option value="NEGATIVO" <?php echo (($elisa['ag_parvovirus'] === "NEGATIVO") ? "selected" : "")  ?>>NEGATIVO</option>
                    </select>
                    <label>AG PARVOVIRUS</label>
                </div>
                <button class="btn btn-primary" type="button" onclick="resetAllSelects()"><i class='fas fa-broom fa-fw'></i> Limpiar selecciones</button>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 justify-content-md-end">
                    <button class="btn btn-warning">Actualizar elisa</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>