<?php
$species = $specie_controller->options();

echo "<option value='' disabled selected>SELECCIONA UNA OPCIÓN</option>";
while ($temp_specie = $species->fetch_assoc()) {
    $selected = isset($specie) ? ($temp_specie['specie_id'] == $specie['specie_id'] ? 'selected' : '') : '';
    echo "<option value={$temp_specie['specie_id']} $selected>{$temp_specie['specie']}</option>";
}