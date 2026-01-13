<?php

require_once '../../../controllers/SessionController.php';

class CitologiaController
{
    public string $UPDATE = "CALL UPDATE_CITOLOGIA(?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_CITOLOGIA(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sssssis", [
                $_POST['descripcion_macroscopica_de_la_lesion'] !== '' ? $_POST['descripcion_macroscopica_de_la_lesion'] : NULL,
                $_POST['descripcion_citologica'] !== '' ? $_POST['descripcion_citologica'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                $_POST['diagnostico'] !== '' ? $_POST['diagnostico'] : NULL,
                $_POST['comentario'] !== '' ? $_POST['comentario'] : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL,
            ]);
            header("Location: ../pdf/citologia.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $citologia_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $citologia_result->fetch_assoc();
    }
}

$citologia_controller = new CitologiaController();
