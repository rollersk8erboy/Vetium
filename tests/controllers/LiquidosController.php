<?php

require_once '../../../controllers/SessionController.php';

class LiquidosController
{
    public string $UPDATE = "CALL UPDATE_LIQUIDOS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_LIQUIDOS(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "ssssssssssssssssssssis", [
                $_POST['tipo_de_liquido'] !== '' ? $_POST['tipo_de_liquido'] : NULL,
                $_POST['apariencia'] !== '' ? $_POST['apariencia'] : NULL,
                $_POST['color'] !== '' ? $_POST['color'] : NULL,
                $_POST['hematocrito'] !== '' ? $_POST['hematocrito'] : NULL,
                $_POST['creatinina'] !== '' ? $_POST['creatinina'] : NULL,
                $_POST['colesterol'] !== '' ? $_POST['colesterol'] : NULL,
                $_POST['trigliceridos'] !== '' ? $_POST['trigliceridos'] : NULL,
                $_POST['bilirrubina'] !== '' ? $_POST['bilirrubina'] : NULL,
                $_POST['proteinas'] !== '' ? $_POST['proteinas'] : NULL,
                $_POST['albumina'] !== '' ? $_POST['albumina'] : NULL,
                $_POST['conteo_celular'] !== '' ? $_POST['conteo_celular'] : NULL,
                $_POST['viscocidad'] !== '' ? $_POST['viscocidad'] : NULL,
                $_POST['prueba_de_mucina'] !== '' ? $_POST['prueba_de_mucina'] : NULL,
                $_POST['prueba_de_pandy'] !== '' ? $_POST['prueba_de_pandy'] : NULL,
                $_POST['descripcion_microscopica'] !== '' ? $_POST['descripcion_microscopica'] : NULL,
                $_POST['globulinas'] !== '' ? $_POST['globulinas'] : NULL,
                $_POST['relacion_ag'] !== '' ? $_POST['relacion_ag'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                $_POST['diagnostico'] !== '' ? $_POST['diagnostico'] : NULL,
                $_POST['comentario'] !== '' ? $_POST['comentario'] : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/liquidos.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $bioquimica_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $bioquimica_result->fetch_assoc();
    }
}

$liquidos_controller = new LiquidosController();
