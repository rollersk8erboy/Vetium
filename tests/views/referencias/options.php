<?php
$referencias = $referencia_controller->options($specie['specie_id']);

echo "<option value='' disabled selected>SELECCIONA UNA OPCIÓN</option>";
while ($temp_referencia = $referencias->fetch_assoc()) {
    $selected = isset($referencia) ? ($temp_referencia['referencia_id'] == $referencia['referencia_id'] ? 'selected' : '') : '';
    echo "<option value={$temp_referencia['referencia_id']} $selected>{$temp_referencia['descripcion']}</option>";
}