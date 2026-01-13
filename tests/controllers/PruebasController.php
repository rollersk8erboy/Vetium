<?php

require_once '../../../controllers/SessionController.php';

class PruebasController
{
    public string $UPDATE = "CALL UPDATE_PRUEBAS(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $SHOW = "CALL SELECT_PRUEBAS(?)";

    public function update($fk_item_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "dssssssssssssssssssssssssssssssssssssssssssssssii", [
                $_POST['hematocrito'] !== '' ? $_POST['hematocrito'] : NULL,
                $_POST['donador_1'] !== '' ? $_POST['donador_1'] : NULL,
                $_POST['hematocrito_donador_1'] !== '' ? $_POST['hematocrito_donador_1'] : NULL,
                $_POST['prueba_mayor_apariencia_donador_1'] !== '' ? $_POST['prueba_mayor_apariencia_donador_1'] : NULL,
                $_POST['prueba_menor_apariencia_donador_1'] !== '' ? $_POST['prueba_menor_apariencia_donador_1'] : NULL,
                $_POST['prueba_mayor_agregados_celulares_donador_1'] !== '' ? $_POST['prueba_mayor_agregados_celulares_donador_1'] : NULL,
                $_POST['prueba_menor_agregados_celulares_donador_1'] !== '' ? $_POST['prueba_menor_agregados_celulares_donador_1'] : NULL,
                $_POST['prueba_mayor_aglutinacion_donador_1'] !== '' ? $_POST['prueba_mayor_aglutinacion_donador_1'] : NULL,
                $_POST['prueba_menor_aglutinacion_donador_1'] !== '' ? $_POST['prueba_menor_aglutinacion_donador_1'] : NULL,
                $_POST['observaciones_donador_1'] !== '' ? $_POST['observaciones_donador_1'] : NULL,
                $_POST['donador_2'] !== '' ? $_POST['donador_2'] : NULL,
                $_POST['hematocrito_donador_2'] !== '' ? $_POST['hematocrito_donador_2'] : NULL,
                $_POST['prueba_mayor_apariencia_donador_2'] !== '' ? $_POST['prueba_mayor_apariencia_donador_2'] : NULL,
                $_POST['prueba_menor_apariencia_donador_2'] !== '' ? $_POST['prueba_menor_apariencia_donador_2'] : NULL,
                $_POST['prueba_mayor_agregados_celulares_donador_2'] !== '' ? $_POST['prueba_mayor_agregados_celulares_donador_2'] : NULL,
                $_POST['prueba_menor_agregados_celulares_donador_2'] !== '' ? $_POST['prueba_menor_agregados_celulares_donador_2'] : NULL,
                $_POST['prueba_mayor_aglutinacion_donador_2'] !== '' ? $_POST['prueba_mayor_aglutinacion_donador_2'] : NULL,
                $_POST['prueba_menor_aglutinacion_donador_2'] !== '' ? $_POST['prueba_menor_aglutinacion_donador_2'] : NULL,
                $_POST['observaciones_donador_2'] !== '' ? $_POST['observaciones_donador_2'] : NULL,
                $_POST['donador_3'] !== '' ? $_POST['donador_3'] : NULL,
                $_POST['hematocrito_donador_3'] !== '' ? $_POST['hematocrito_donador_3'] : NULL,
                $_POST['prueba_mayor_apariencia_donador_3'] !== '' ? $_POST['prueba_mayor_apariencia_donador_3'] : NULL,
                $_POST['prueba_menor_apariencia_donador_3'] !== '' ? $_POST['prueba_menor_apariencia_donador_3'] : NULL,
                $_POST['prueba_mayor_agregados_celulares_donador_3'] !== '' ? $_POST['prueba_mayor_agregados_celulares_donador_3'] : NULL,
                $_POST['prueba_menor_agregados_celulares_donador_3'] !== '' ? $_POST['prueba_menor_agregados_celulares_donador_3'] : NULL,
                $_POST['prueba_mayor_aglutinacion_donador_3'] !== '' ? $_POST['prueba_mayor_aglutinacion_donador_3'] : NULL,
                $_POST['prueba_menor_aglutinacion_donador_3'] !== '' ? $_POST['prueba_menor_aglutinacion_donador_3'] : NULL,
                $_POST['observaciones_donador_3'] !== '' ? $_POST['observaciones_donador_3'] : NULL,
                $_POST['donador_4'] !== '' ? $_POST['donador_4'] : NULL,
                $_POST['hematocrito_donador_4'] !== '' ? $_POST['hematocrito_donador_4'] : NULL,
                $_POST['prueba_mayor_apariencia_donador_4'] !== '' ? $_POST['prueba_mayor_apariencia_donador_4'] : NULL,
                $_POST['prueba_menor_apariencia_donador_4'] !== '' ? $_POST['prueba_menor_apariencia_donador_4'] : NULL,
                $_POST['prueba_mayor_agregados_celulares_donador_4'] !== '' ? $_POST['prueba_mayor_agregados_celulares_donador_4'] : NULL,
                $_POST['prueba_menor_agregados_celulares_donador_4'] !== '' ? $_POST['prueba_menor_agregados_celulares_donador_4'] : NULL,
                $_POST['prueba_mayor_aglutinacion_donador_4'] !== '' ? $_POST['prueba_mayor_aglutinacion_donador_4'] : NULL,
                $_POST['prueba_menor_aglutinacion_donador_4'] !== '' ? $_POST['prueba_menor_aglutinacion_donador_4'] : NULL,
                $_POST['observaciones_donador_4'] !== '' ? $_POST['observaciones_donador_4'] : NULL,
                $_POST['donador_5'] !== '' ? $_POST['donador_5'] : NULL,
                $_POST['hematocrito_donador_5'] !== '' ? $_POST['hematocrito_donador_5'] : NULL,
                $_POST['prueba_mayor_apariencia_donador_5'] !== '' ? $_POST['prueba_mayor_apariencia_donador_5'] : NULL,
                $_POST['prueba_menor_apariencia_donador_5'] !== '' ? $_POST['prueba_menor_apariencia_donador_5'] : NULL,
                $_POST['prueba_mayor_agregados_celulares_donador_5'] !== '' ? $_POST['prueba_mayor_agregados_celulares_donador_5'] : NULL,
                $_POST['prueba_menor_agregados_celulares_donador_5'] !== '' ? $_POST['prueba_menor_agregados_celulares_donador_5'] : NULL,
                $_POST['prueba_mayor_aglutinacion_donador_5'] !== '' ? $_POST['prueba_mayor_aglutinacion_donador_5'] : NULL,
                $_POST['prueba_menor_aglutinacion_donador_5'] !== '' ? $_POST['prueba_menor_aglutinacion_donador_5'] : NULL,
                $_POST['observaciones_donador_5'] !== '' ? $_POST['observaciones_donador_5'] : NULL,
                $_POST['interpretaciones'] !== '' ? $_POST['interpretaciones'] : NULL,
                $fk_item_id,
                isset($_POST['fk_referencia_id']) ? ($_POST['fk_referencia_id'] !== '' ? $_POST['fk_referencia_id'] : NULL) : NULL,
            ]);
            header("Location: ../pdf/pruebas.php?item_id=$fk_item_id");
        }
    }

    public function show($fk_item_id)
    {
        $database_controller = new DatabaseController();
        $pruebas_result = $database_controller->read($this->SHOW, "i", [$fk_item_id]);
        return $pruebas_result->fetch_assoc();
    }
}

$pruebas_controller = new PruebasController();
