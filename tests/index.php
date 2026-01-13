<?php
require_once '../controllers/DatabaseController.php';
require_once '../controllers/StudyController.php';
$study = $study_controller->show($_GET['study_id']);

if ($study['form'] == 'BIOQUÍMICA') {
    header("Location: ../tests/views/bioquimicas/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'HEMOGRAMA') {
    header("Location: ../tests/views/hemogramas/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'TIEMPOS DE COAGULACIÓN') {
    header("Location: ../tests/views/tiempos/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'CITOLOGÍA') {
    header("Location: ../tests/views/citologias/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'RASPADO CUTÁNEO') {
    header("Location: ../tests/views/raspados/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'COPROPARASITOSCÓPICO') {
    header("Location: ../tests/views/coproparasitoscopicos/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'PRUEBAS CRUZADAS') {
    header("Location: ../tests/views/pruebas/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'ELISA') {
    header("Location: ../tests/views/elisas/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'ANÁLISIS DE LÍQUIDOS') {
    header("Location: ../tests/views/liquidos/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'URIANÁLISIS') {
    header("Location: ../tests/views/urianalisis/edit.php?item_id={$_GET['item_id']}");
}
if ($study['form'] == 'VALOR DE K') {
    header("Location: ../tests/views/k/edit.php?item_id={$_GET['item_id']}");
}

