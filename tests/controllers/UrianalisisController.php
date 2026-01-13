<?php

require_once '../../../controllers/SessionController.php';

class UrianalisisController
{
    public string $UPDATE = "CALL UPDATE_URIANALISIS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_URIANALISIS(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sssssssssssssssssssssis", [
                $_POST['metodo_de_obtencion'] !== '' ? $_POST['metodo_de_obtencion'] : NULL,
                $_POST['apariencia'] !== '' ? $_POST['apariencia'] : NULL,
                $_POST['color'] !== '' ? $_POST['color'] : NULL,
                $_POST['densidad'] !== '' ? $_POST['densidad'] : NULL,
                $_POST['ph'] !== '' ? $_POST['ph'] : NULL,
                $_POST['proteinas'] !== '' ? $_POST['proteinas'] : NULL,
                $_POST['glucosa'] !== '' ? $_POST['glucosa'] : NULL,
                $_POST['cetonas'] !== '' ? $_POST['cetonas'] : NULL,
                $_POST['bilirrubina'] !== '' ? $_POST['bilirrubina'] : NULL,
                $_POST['hemoglobina'] !== '' ? $_POST['hemoglobina'] : NULL,
                $_POST['eritrocitos'] !== '' ? $_POST['eritrocitos'] : NULL,
                $_POST['leucocitos'] !== '' ? $_POST['leucocitos'] : NULL,
                $_POST['celulas_epiteliales_transitorias'] !== '' ? $_POST['celulas_epiteliales_transitorias'] : NULL,
                $_POST['celulas_epiteliales_mosas'] !== '' ? $_POST['celulas_epiteliales_mosas'] : NULL,
                $_POST['cilindros'] !== '' ? $_POST['cilindros'] : NULL,
                $_POST['tipo'] !== '' ? $_POST['tipo'] : NULL,
                $_POST['cristales'] !== '' ? $_POST['cristales'] : NULL,
                $_POST['bacterias'] !== '' ? $_POST['bacterias'] : NULL,
                $_POST['lipidos'] !== '' ? $_POST['lipidos'] : NULL,
                $_POST['otros'] !== '' ? $_POST['otros'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/urianalisis.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $bioquimica_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $bioquimica_result->fetch_assoc();
    }
}

$urianalisis_controller = new UrianalisisController();
