<?php

require_once '../../../controllers/SessionController.php';

class TiemposController
{
    public string $UPDATE = "CALL UPDATE_TIEMPOS(?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_TIEMPOS(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sssiis", [
                $_POST['tiempo_de_tromboplastina'] !== '' ? $_POST['tiempo_de_tromboplastina'] : NULL,
                $_POST['tiempo_de_protrombina'] !== '' ? $_POST['tiempo_de_protrombina'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                isset($_POST['fk_referencia_id']) ? ($_POST['fk_referencia_id'] !== '' ? $_POST['fk_referencia_id'] : NULL) : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/tiempos.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $tiempos_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $tiempos_result->fetch_assoc();
    }
}

$tiempos_controller = new TiemposController();
