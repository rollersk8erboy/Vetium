<!DOCTYPE html>
<html lang="es">

<?php
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/CaseController.php';
require_once '../../controllers/SpecieController.php';
$case_controller->store();
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <form class="card bg-light" autocomplete="off" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="col form-floating mb-3">
                            <select class="form-select" name="fk_clinic_id" required>
                                <?php require_once '../../views/clinics/options.php'; ?>
                            </select>
                            <label>Clínica</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="fk_specie_id" onchange="getBreeds()" required>
                                <?php require_once '../../views/species/options.php'; ?>
                            </select>
                            <label>Especie</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="fk_breed_id" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                            </select>
                            <label>Raza</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="sex" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="SIN ESPECIFICAR">SIN ESPECIFICAR</option>
                                <option value="MACHO">MACHO</option>
                                <option value="MACHO">MACHO ESTERILIZADO</option>
                                <option value="HEMBRA">HEMBRA</option>
                                <option value="HEMBRA">HEMBRA ESTERILIZADO</option>
                            </select>
                            <label>Sexo</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="body_condition_score" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="5/5">5/5</option>
                                <option value="4/5">4/5</option>
                                <option value="3/5">3/5</option>
                                <option value="2/5">2/5</option>
                                <option value="1/5">1/5</option>
                            </select>
                            <label>Condición corporal</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="pet" required>
                            <label>Mascota</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="age" required>
                            <label>Edad</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="anamnesis">
                            <label>Anamnesis</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="rollersk8erboy" name="treatment">
                            <label>Tratamiento</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="price_type" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="NORMAL">NORMAL</option>
                                <option value="ESPECIAL">ESPECIAL</option>
                            </select>
                            <label>Precio</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="invoice" required>
                                <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                                <option value="SÍ">SÍ</option>
                                <option value="NO">NO</option>
                            </select>
                            <label>¿Requiere factura?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success">Agregar caso</button>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
    function getBreeds() {
        $.ajax({
            type: "POST",
            url: "../breeds/options.php",
            data: {
                specie_id: $("[name='fk_specie_id']").val()
            },
            success: function(data) {
                $("[name='fk_breed_id']").html(data);
            }
        });
    }
</script>

</html>