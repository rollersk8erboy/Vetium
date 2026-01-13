<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ClinicController.php';
$clinics = $clinic_controller->options();

echo "<option value='' disabled selected>SELECCIONA UNA OPCIÓN</option>";
while ($temp_clinic = $clinics->fetch_assoc()) {
    $selected = isset($clinic) ? ($temp_clinic['clinic_id'] == $clinic['clinic_id'] ? 'selected' : '') : '';
    echo "<option value={$temp_clinic['clinic_id']} $selected>{$temp_clinic['clinic']}</option>";
}
