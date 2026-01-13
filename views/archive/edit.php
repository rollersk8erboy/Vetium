<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/CaseController.php';
require_once '../../controllers/ClinicController.php';
require_once '../../controllers/BreedController.php';
require_once '../../controllers/SpecieController.php';

$case = $case_controller->show($_GET['case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);

$case_controller->update();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="col form-floating mb-3 mt-3">
                            <select class="form-select" name="fk_clinic_id" onchange="getPets()" required>
                                <?php require_once '../../views/clinics/options.php'; ?>
                            </select>
                            <label>Clínica</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="fk_specie_id" onchange="getBreeds()" required>
                                <?php require_once '../../views/species/options.php'; ?>
                            </select>
                            <label>Especie</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="fk_breed_id" required>
                                <?php require_once '../../views/breeds/options.php'; ?>
                            </select>
                            <label>Raza</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="sex" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="SIN ESPECIFICAR" <?php echo (($case['sex'] === "SIN ESPECIFICAR") ? "selected" : "")  ?>>SIN ESPECIFICAR</option>
                                <option value="MACHO" <?php echo (($case['sex'] === "MACHO") ? "selected" : "")  ?>>MACHO</option>
                                <option value="MACHO ESTERILIZADO" <?php echo (($case['sex'] === "MACHO ESTERIZADO") ? "selected" : "")  ?>>MACHO ESTERILIZADO</option>
                                <option value="HEMBRA" <?php echo (($case['sex'] === "HEMBRA") ? "selected" : "")  ?>>HEMBRA</option>
                                <option value="HEMBRA ESTERILIZADO" <?php echo (($case['sex'] === "HEMBRA ESTERILIZADO") ? "selected" : "")  ?>>HEMBRA ESTERILIZADO</option>
                            </select>
                            <label>Sexo</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="body_condition_score" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="5/5" <?php echo (($case['body_condition_score'] === "5/5") ? "selected" : "")  ?>>5/5</option>
                                <option value="4/5" <?php echo (($case['body_condition_score'] === "4/5") ? "selected" : "")  ?>>4/5</option>
                                <option value="3/5" <?php echo (($case['body_condition_score'] === "3/5") ? "selected" : "")  ?>>3/5</option>
                                <option value="2/5" <?php echo (($case['body_condition_score'] === "2/5") ? "selected" : "")  ?>>2/5</option>
                                <option value="1/5" <?php echo (($case['body_condition_score'] === "1/5") ? "selected" : "")  ?>>1/5</option>
                            </select>
                            <label>Condición corporal</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="pet" value="<?php echo $case['pet'] ?>" required>
                            <label>Mascota</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="age" value="<?php echo $case['age'] ?>" required>
                            <label>Edad</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="anamnesis" value="<?php echo $case['anamnesis'] ?>">
                            <label>Anamnesis</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="treatment" value="<?php echo $case['treatment'] ?>">
                            <label>Tratamiento</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="price_type" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="NORMAL" <?php echo (($case['price_type'] === "NORMAL") ? "selected" : "")  ?>>NORMAL</option>
                                <option value="ESPECIAL" <?php echo (($case['price_type'] === "ESPECIAL") ? "selected" : "")  ?>>ESPECIAL</option>
                            </select>
                            <label>Precio</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="invoice" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="SÍ" <?php echo (($case['invoice'] === "SÍ") ? "selected" : "")  ?>>SÍ</option>
                                <option value="NO" <?php echo (($case['invoice'] === "NO") ? "selected" : "")  ?>>NO</option>
                            </select>
                            <label>¿Requiere factura?</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select" name="delivery_status" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="ENTREGADO" <?php echo (($case['delivery_status'] === "ENTREGADO") ? "selected" : "")  ?>>ENTREGADO</option>
                                <option value="NO ENTREGADO" <?php echo (($case['delivery_status'] === "NO ENTREGADO") ? "selected" : "")  ?>>NO ENTREGADO</option>
                            </select>
                            <label>Estado de entrega</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning">Actualizar caso</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<script>
    function getBreeds() {
        $.ajax({
            type: "POST",
            url: "../breeds/options.php",
            data: {
                specie_id: $("[name='fk_specie_id']").val(),
            },
            success: function(data) {
                $("[name='fk_breed_id']").html(data);
            }
        });
    }
</script>