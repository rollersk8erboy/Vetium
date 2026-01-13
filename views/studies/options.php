<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/StudyController.php';

$studies = $study_controller->options($case['case_id']);
echo "<option value='' disabled selected>SELECCIONA UNA OPCIÓN</option>";
while ($study = $studies->fetch_assoc()) {
    echo "<option value={$study['study_id']}>{$study['study']} - {$study['price']}</option>";
}
