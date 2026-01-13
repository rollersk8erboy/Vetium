<?php

require_once '../../../controllers/SessionController.php';

class CoproparasitoscopicooController
{
    public string $UPDATE = "CALL UPDATE_COPROPARASITOSCOPICO(?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_COPROPARASITOSCOPICO(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sssssssi", [
                $_POST['prueba'] !== '' ? $_POST['prueba'] : NULL,
                $_POST['resultado_1'] !== '' ? $_POST['resultado_1'] : NULL,
                $_POST['resultado_2'] !== '' ? $_POST['resultado_2'] : NULL,
                $_POST['resultado_3'] !== '' ? $_POST['resultado_3'] : NULL,
                $_POST['fecha_1'] !== '' ? $_POST['fecha_1'] : NULL,
                $_POST['fecha_2'] !== '' ? $_POST['fecha_2'] : NULL,
                $_POST['fecha_3'] !== '' ? $_POST['fecha_3'] : NULL,
                $fk_item_id
            ]);
            header("Location: ../pdf/coproparasitoscopico.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $bioquimica_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $bioquimica_result->fetch_assoc();
    }
}

$coproparasitoscopico_controller = new CoproparasitoscopicooController();
