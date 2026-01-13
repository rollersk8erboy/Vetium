<?php

require_once '../../../controllers/SessionController.php';

class RaspadoController
{
    public string $UPDATE = "CALL UPDATE_RASPADO(?, ?, ?)";
    public string $SHOW = "CALL SELECT_RASPADO(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sis", [
                $_POST['resultado'] !== '' ? $_POST['resultado'] : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL,
            ]);
            header("Location: ../pdf/raspado.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $bioquimica_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $bioquimica_result->fetch_assoc();
    }
}

$raspado_controller = new RaspadoController();
