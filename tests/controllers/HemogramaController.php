<?php

require_once '../../../controllers/SessionController.php';

class HemogramaController
{
    public string $UPDATE = "CALL UPDATE_HEMOGRAMA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_HEMOGRAMA(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "dddddddddddddddddddddddddddddddsssssssissiis", [
                $_POST['hematocrito'] !== '' ? $_POST['hematocrito'] : NULL,
                $_POST['eritrocitos'] !== '' ? $_POST['eritrocitos'] : NULL,
                $_POST['hemoglobina'] !== '' ? $_POST['hemoglobina'] : NULL,
                $_POST['reticulocitos'] !== '' ? $_POST['reticulocitos'] : NULL,
                $_POST['reticulocito_1'] !== '' ? $_POST['reticulocito_1'] : NULL,
                $_POST['reticulocito_2'] !== '' ? $_POST['reticulocito_2'] : NULL,
                $_POST['reticulocito_3'] !== '' ? $_POST['reticulocito_3'] : NULL,
                $_POST['reticulocito_4'] !== '' ? $_POST['reticulocito_4'] : NULL,
                $_POST['reticulocito_5'] !== '' ? $_POST['reticulocito_5'] : NULL,
                $_POST['reticulocito_6'] !== '' ? $_POST['reticulocito_6'] : NULL,
                $_POST['reticulocito_7'] !== '' ? $_POST['reticulocito_7'] : NULL,
                $_POST['reticulocito_8'] !== '' ? $_POST['reticulocito_8'] : NULL,
                $_POST['reticulocito_9'] !== '' ? $_POST['reticulocito_9'] : NULL,
                $_POST['reticulocito_10'] !== '' ? $_POST['reticulocito_10'] : NULL,
                $_POST['plaqueta_1'] !== '' ? $_POST['plaqueta_1'] : NULL,
                $_POST['plaqueta_2'] !== '' ? $_POST['plaqueta_2'] : NULL,
                $_POST['plaqueta_3'] !== '' ? $_POST['plaqueta_3'] : NULL,
                $_POST['plaqueta_4'] !== '' ? $_POST['plaqueta_4'] : NULL,
                $_POST['plaqueta_5'] !== '' ? $_POST['plaqueta_5'] : NULL,
                $_POST['solidos_totales'] !== '' ? $_POST['solidos_totales'] : NULL,
                $_POST['proteina_1'] !== '' ? $_POST['proteina_1'] : NULL,
                $_POST['proteina_2'] !== '' ? $_POST['proteina_2'] : NULL,
                $_POST['leucocitos'] !== '' ? $_POST['leucocitos'] : NULL,
                $_POST['neutrofilos'] !== '' ? $_POST['neutrofilos'] : NULL,
                $_POST['bandas'] !== '' ? $_POST['bandas'] : NULL,
                $_POST['metamielocitos'] !== '' ? $_POST['metamielocitos'] : NULL,
                $_POST['mielocitos'] !== '' ? $_POST['mielocitos'] : NULL,
                $_POST['linfocitos'] !== '' ? $_POST['linfocitos'] : NULL,
                $_POST['monocitos'] !== '' ? $_POST['monocitos'] : NULL,
                $_POST['eosinofilos'] !== '' ? $_POST['eosinofilos'] : NULL,
                $_POST['basofilos'] !== '' ? $_POST['basofilos'] : NULL,
                $_POST['anisocitosis'] !== '' ? $_POST['anisocitosis'] : NULL,
                $_POST['policromasia'] !== '' ? $_POST['policromasia'] : NULL,
                $_POST['aglutinacion'] !== '' ? $_POST['aglutinacion'] : NULL,
                $_POST['poiquilocitos'] !== '' ? $_POST['poiquilocitos'] : NULL,
                $_POST['neutrofilos_toxicos'] !== '' ? $_POST['neutrofilos_toxicos'] : NULL,
                $_POST['linfocitos_reactivos'] !== '' ? $_POST['linfocitos_reactivos'] : NULL,
                $_POST['otros_hallazgos'] !== '' ? $_POST['otros_hallazgos'] : NULL,
                $_POST['eritrocitos_nucleados'] !== '' ? $_POST['eritrocitos_nucleados'] : NULL,
                $_POST['observaciones'] !== '' ? $_POST['observaciones'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                isset($_POST['fk_referencia_id']) ? ($_POST['fk_referencia_id'] !== '' ? $_POST['fk_referencia_id'] : NULL) : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/hemograma.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $hemograma_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $hemograma_result->fetch_assoc();
    }
}

$hemograma_controller = new HemogramaController();
