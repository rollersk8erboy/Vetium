<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/BreedController.php';

$breeds = $breed_controller->options(isset($specie['specie_id']) ? $specie['specie_id'] : 0);

echo "<option value='' disabled selected>SELECCIONA UNA OPCIÓN</option>";
while ($temp_breed = $breeds->fetch_assoc()) {
    $selected = isset($breed) ? ($temp_breed['breed_id'] == $breed['breed_id'] ? 'selected' : '') : '';
    echo "<option value={$temp_breed['breed_id']} $selected>{$temp_breed['breed']}</option>";
}
