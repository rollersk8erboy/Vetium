<?php

require_once '../../../controllers/SessionController.php';

class KController
{
    public string $UPDATE = "CALL UPDATE_K(?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_K(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "ddssiis", [
                $_POST['colesterol'] !== '' ? $_POST['colesterol'] : NULL,
                $_POST['t4_libre'] !== '' ? $_POST['t4_libre'] : NULL,
                $_POST['diagnostico'] !== '' ? $_POST['diagnostico'] : NULL,
                $_POST['valores_de_referencia'] !== '' ? $_POST['valores_de_referencia'] : NULL,
                isset($_POST['fk_referencia_id']) ? ($_POST['fk_referencia_id'] !== '' ? $_POST['fk_referencia_id'] : NULL) : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL,
            ]);
            header("Location: ../pdf/k.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $k_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $k_result->fetch_assoc();
    }
}

$k_controller = new KController();
