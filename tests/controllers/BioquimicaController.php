<?php

require_once '../../../controllers/SessionController.php';

class BioquimicaController
{
    public string $UPDATE = "CALL UPDATE_BIOQUIMICA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_BIOQUIMICA(?)";


    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "ddddddddddddddddddddddddssiis", [
                $_POST['glucosa'] !== '' ? $_POST['glucosa'] : NULL,
                $_POST['urea'] !== '' ? $_POST['urea'] : NULL,
                $_POST['creatinina'] !== '' ? $_POST['creatinina'] : NULL,
                $_POST['colesterol'] !== '' ? $_POST['colesterol'] : NULL,
                $_POST['trigliceridos'] !== '' ? $_POST['trigliceridos'] : NULL,
                $_POST['bilirrubina_total'] !== '' ? $_POST['bilirrubina_total'] : NULL,
                $_POST['bilirrubina_conjugada'] !== '' ? $_POST['bilirrubina_conjugada'] : NULL,
                $_POST['alanina_aminotransferasa'] !== '' ? $_POST['alanina_aminotransferasa'] : NULL,
                $_POST['aspartato_aminotransferasa'] !== '' ? $_POST['aspartato_aminotransferasa'] : NULL,
                $_POST['fosfatasa_alcalina'] !== '' ? $_POST['fosfatasa_alcalina'] : NULL,
                $_POST['amilasa'] !== '' ? $_POST['amilasa'] : NULL,
                $_POST['lipasa'] !== '' ? $_POST['lipasa'] : NULL,
                $_POST['creatinacinasa'] !== '' ? $_POST['creatinacinasa'] : NULL,
                $_POST['glutamato_deshidrogenasa'] !== '' ? $_POST['glutamato_deshidrogenasa'] : NULL,
                $_POST['gamaglutamil_transferasa'] !== '' ? $_POST['gamaglutamil_transferasa'] : NULL,
                $_POST['proteinas_totales'] !== '' ? $_POST['proteinas_totales'] : NULL,
                $_POST['albumina'] !== '' ? $_POST['albumina'] : NULL,
                $_POST['calcio'] !== '' ? $_POST['calcio'] : NULL,
                $_POST['fosforo'] !== '' ? $_POST['fosforo'] : NULL,
                $_POST['potasio'] !== '' ? $_POST['potasio'] : NULL,
                $_POST['sodio'] !== '' ? $_POST['sodio'] : NULL,
                $_POST['cloro'] !== '' ? $_POST['cloro'] : NULL,
                $_POST['bicarbonato'] !== '' ? $_POST['bicarbonato'] : NULL,
                $_POST['amonio'] !== '' ? $_POST['amonio'] : NULL,
                $_POST['observaciones'] !== '' ? $_POST['observaciones'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                isset($_POST['fk_referencia_id']) ? ($_POST['fk_referencia_id'] !== '' ? $_POST['fk_referencia_id'] : NULL) : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/bioquimica.php?item_id=$fk_item_id");
        }
    }



    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $bioquimica_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $bioquimica_result->fetch_assoc();
    }
}

$bioquimica_controller = new BioquimicaController();
