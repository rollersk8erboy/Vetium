<?php

require_once '../../../controllers/SessionController.php';

class ElisaController
{
    public string $UPDATE = "CALL UPDATE_ELISA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_ELISA(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "ssssssssssis", [
                $_POST['observaciones'] !== '' ? $_POST['observaciones'] : NULL,
                isset($_POST['ac_anaplasma']) ? $_POST['ac_anaplasma'] : NULL,
                isset($_POST['ac_borrelia_burgdorferi']) ? $_POST['ac_borrelia_burgdorferi'] : NULL,
                isset($_POST['ac_ehrlichia_canis']) ? $_POST['ac_ehrlichia_canis'] : NULL,
                isset($_POST['ac_vif']) ? $_POST['ac_vif'] : NULL,
                isset($_POST['ag_dirofilaria_immitis']) ? $_POST['ag_dirofilaria_immitis'] : NULL,
                isset($_POST['ag_filaria']) ? $_POST['ag_filaria'] : NULL,
                isset($_POST['ag_distemper_canino']) ? $_POST['ag_distemper_canino'] : NULL,
                isset($_POST['ag_levf']) ? $_POST['ag_levf'] : NULL,
                isset($_POST['ag_parvovirus']) ? $_POST['ag_parvovirus'] : NULL,
                $fk_item_id,
                $_POST['fecha'] !== '' ? $_POST['fecha'] : NULL
            ]);
            header("Location: ../pdf/elisa.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $elisa_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $elisa_result->fetch_assoc();
    }
}

$elisa_controller = new ElisaController();
