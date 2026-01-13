<?php

require_once '../../../controllers/SessionController.php';

class ReferenciaController
{
    public string $INDEX = "CALL SELECT_PAGINED_REFERENCIAS(?, ?, ?)";
    public string $STORE = "CALL INSERT_REFERENCIA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $UPDATE = "CALL UPDATE_REFERENCIA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_REFERENCIA(?)";
    public string $SHOW = "CALL SELECT_REFERENCIA(?)";
    public string $OPTIONS = "CALL SELECT_REFERENCIAS(?)";

    public string $Q;
    public string $PAGE;
    public int $REFERENCIAS_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->REFERENCIAS_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->REFERENCIAS_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "ssssssssssssssssssssssssssssssssssssssssssssssssssssssi", [
                trim($_POST['descripcion']) !== '' ? $_POST['descripcion'] : NULL,
                trim($_POST["hematocrito"]) !== '' ? $_POST['hematocrito'] : NULL,
                trim($_POST["eritrocitos"]) !== '' ? $_POST['eritrocitos'] : NULL,
                trim($_POST["hemoglobina"]) !== '' ? $_POST['hemoglobina'] : NULL,
                trim($_POST["vgm"]) !== '' ? $_POST['vgm'] : NULL,
                trim($_POST['cgmh']) !== '' ? $_POST['cgmh'] : NULL,
                trim($_POST["reticulocitos"]) !== '' ? $_POST['reticulocitos'] : NULL,
                trim($_POST["plaquetas"]) !== '' ? $_POST['plaquetas'] : NULL,
                trim($_POST["solidos_totales"]) !== '' ? $_POST['solidos_totales'] : NULL,
                trim($_POST["fibrinogeno"]) !== '' ? $_POST['fibrinogeno'] : NULL,
                trim($_POST["relacion_ptfib"]) !== '' ? $_POST['relacion_ptfib'] : NULL,
                trim($_POST['leucocitos']) !== '' ? $_POST['leucocitos'] : NULL,
                trim($_POST["neutrofilos"]) !== '' ? $_POST['neutrofilos'] : NULL,
                trim($_POST["bandas"]) !== '' ? $_POST['bandas'] : NULL,
                trim($_POST["metamielocitos"]) !== '' ? $_POST['metamielocitos'] : NULL,
                trim($_POST["mielocitos"]) !== '' ? $_POST['mielocitos'] : NULL,
                trim($_POST['linfocitos']) !== '' ? $_POST['linfocitos'] : NULL,
                trim($_POST["monocitos"]) !== '' ? $_POST['monocitos'] : NULL,
                trim($_POST["eosinofilos"]) !== '' ? $_POST['eosinofilos'] : NULL,
                trim($_POST["basofilos"]) !== '' ? $_POST['basofilos'] : NULL,
                trim($_POST['glucosa']) !== '' ? $_POST['glucosa'] : NULL,
                trim($_POST['urea']) !== '' ? $_POST['urea'] : NULL,
                trim($_POST["creatinina"]) !== '' ? $_POST['creatinina'] : NULL,
                trim($_POST["colesterol"]) !== '' ? $_POST['colesterol'] : NULL,
                trim($_POST["trigliceridos"]) !== '' ? $_POST['trigliceridos'] : NULL,
                trim($_POST["bilirrubina_total"]) !== '' ? $_POST['bilirrubina_total'] : NULL,
                trim($_POST['bilirrubina_conjugada']) !== '' ? $_POST['bilirrubina_conjugada'] : NULL,
                trim($_POST["bilirrubina_no_conjugada"]) !== '' ? $_POST['bilirrubina_no_conjugada'] : NULL,
                trim($_POST["alanina_aminotransferasa"]) !== '' ? $_POST['alanina_aminotransferasa'] : NULL,
                trim($_POST["aspartato_aminotransferasa"]) !== '' ? $_POST['aspartato_aminotransferasa'] : NULL,
                trim($_POST["fosfatasa_alcalina"]) !== '' ? $_POST['fosfatasa_alcalina'] : NULL,
                trim($_POST['amilasa']) !== '' ? $_POST['amilasa'] : NULL,
                trim($_POST["lipasa"]) !== '' ? $_POST['lipasa'] : NULL,
                trim($_POST["creatinacinasa"]) !== '' ? $_POST['creatinacinasa'] : NULL,
                trim($_POST["glutamato_deshidrogenasa"]) !== '' ? $_POST['glutamato_deshidrogenasa'] : NULL,
                trim($_POST["gamaglutamil_transferasa"]) !== '' ? $_POST['gamaglutamil_transferasa'] : NULL,
                trim($_POST['proteinas_totales']) !== '' ? $_POST['proteinas_totales'] : NULL,
                trim($_POST["albumina"]) !== '' ? $_POST['albumina'] : NULL,
                trim($_POST["globulinas"]) !== '' ? $_POST['globulinas'] : NULL,
                trim($_POST["relacion_ag"]) !== '' ? $_POST['relacion_ag'] : NULL,
                trim($_POST["calcio"]) !== '' ? $_POST['calcio'] : NULL,
                trim($_POST['fosforo']) !== '' ? $_POST['fosforo'] : NULL,
                trim($_POST["potasio"]) !== '' ? $_POST['potasio'] : NULL,
                trim($_POST["sodio"]) !== '' ? $_POST['sodio'] : NULL,
                trim($_POST["relacion_nak"]) !== '' ? $_POST['relacion_nak'] : NULL,
                trim($_POST["cloro"]) !== '' ? $_POST['cloro'] : NULL,
                trim($_POST["bicarbonato"]) !== '' ? $_POST['bicarbonato'] : NULL,
                trim($_POST['brecha_anionica']) !== '' ? $_POST['brecha_anionica'] : NULL,
                trim($_POST["diferencia_de_iones_fuertes"]) !== '' ? $_POST['diferencia_de_iones_fuertes'] : NULL,
                trim($_POST["osmolalidad"]) !== '' ? $_POST['osmolalidad'] : NULL,
                trim($_POST["amonio"]) !== '' ? $_POST['amonio'] : NULL,
                trim($_POST["tiempo_de_tromboplastina"]) !== '' ? $_POST['tiempo_de_tromboplastina'] : NULL,
                trim($_POST["tiempo_de_protrombina"]) !== '' ? $_POST['tiempo_de_protrombina'] : NULL,
                trim($_POST["t4_libre"]) !== '' ? $_POST['t4_libre'] : NULL,
                $_POST["fk_specie_id"]
            ]);
            header("Location: ../referencias/index.php");
        }
    }

    public function update($referencia_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "issssssssssssssssssssssssssssssssssssssssssssssssssssssi", [
                $referencia_id,
                trim($_POST['descripcion']) !== '' ? $_POST['descripcion'] : NULL,
                trim($_POST["hematocrito"]) !== '' ? $_POST['hematocrito'] : NULL,
                trim($_POST["eritrocitos"]) !== '' ? $_POST['eritrocitos'] : NULL,
                trim($_POST["hemoglobina"]) !== '' ? $_POST['hemoglobina'] : NULL,
                trim($_POST["vgm"]) !== '' ? $_POST['vgm'] : NULL,
                trim($_POST['cgmh']) !== '' ? $_POST['cgmh'] : NULL,
                trim($_POST["reticulocitos"]) !== '' ? $_POST['reticulocitos'] : NULL,
                trim($_POST["plaquetas"]) !== '' ? $_POST['plaquetas'] : NULL,
                trim($_POST["solidos_totales"]) !== '' ? $_POST['solidos_totales'] : NULL,
                trim($_POST["fibrinogeno"]) !== '' ? $_POST['fibrinogeno'] : NULL,
                trim($_POST["relacion_ptfib"]) !== '' ? $_POST['relacion_ptfib'] : NULL,
                trim($_POST['leucocitos']) !== '' ? $_POST['leucocitos'] : NULL,
                trim($_POST["neutrofilos"]) !== '' ? $_POST['neutrofilos'] : NULL,
                trim($_POST["bandas"]) !== '' ? $_POST['bandas'] : NULL,
                trim($_POST["metamielocitos"]) !== '' ? $_POST['metamielocitos'] : NULL,
                trim($_POST["mielocitos"]) !== '' ? $_POST['mielocitos'] : NULL,
                trim($_POST['linfocitos']) !== '' ? $_POST['linfocitos'] : NULL,
                trim($_POST["monocitos"]) !== '' ? $_POST['monocitos'] : NULL,
                trim($_POST["eosinofilos"]) !== '' ? $_POST['eosinofilos'] : NULL,
                trim($_POST["basofilos"]) !== '' ? $_POST['basofilos'] : NULL,
                trim($_POST['glucosa']) !== '' ? $_POST['glucosa'] : NULL,
                trim($_POST['urea']) !== '' ? $_POST['urea'] : NULL,
                trim($_POST["creatinina"]) !== '' ? $_POST['creatinina'] : NULL,
                trim($_POST["colesterol"]) !== '' ? $_POST['colesterol'] : NULL,
                trim($_POST["trigliceridos"]) !== '' ? $_POST['trigliceridos'] : NULL,
                trim($_POST["bilirrubina_total"]) !== '' ? $_POST['bilirrubina_total'] : NULL,
                trim($_POST['bilirrubina_conjugada']) !== '' ? $_POST['bilirrubina_conjugada'] : NULL,
                trim($_POST["bilirrubina_no_conjugada"]) !== '' ? $_POST['bilirrubina_no_conjugada'] : NULL,
                trim($_POST["alanina_aminotransferasa"]) !== '' ? $_POST['alanina_aminotransferasa'] : NULL,
                trim($_POST["aspartato_aminotransferasa"]) !== '' ? $_POST['aspartato_aminotransferasa'] : NULL,
                trim($_POST["fosfatasa_alcalina"]) !== '' ? $_POST['fosfatasa_alcalina'] : NULL,
                trim($_POST['amilasa']) !== '' ? $_POST['amilasa'] : NULL,
                trim($_POST["lipasa"]) !== '' ? $_POST['lipasa'] : NULL,
                trim($_POST["creatinacinasa"]) !== '' ? $_POST['creatinacinasa'] : NULL,
                trim($_POST["glutamato_deshidrogenasa"]) !== '' ? $_POST['glutamato_deshidrogenasa'] : NULL,
                trim($_POST["gamaglutamil_transferasa"]) !== '' ? $_POST['gamaglutamil_transferasa'] : NULL,
                trim($_POST['proteinas_totales']) !== '' ? $_POST['proteinas_totales'] : NULL,
                trim($_POST["albumina"]) !== '' ? $_POST['albumina'] : NULL,
                trim($_POST["globulinas"]) !== '' ? $_POST['globulinas'] : NULL,
                trim($_POST["relacion_ag"]) !== '' ? $_POST['relacion_ag'] : NULL,
                trim($_POST["calcio"]) !== '' ? $_POST['calcio'] : NULL,
                trim($_POST['fosforo']) !== '' ? $_POST['fosforo'] : NULL,
                trim($_POST["potasio"]) !== '' ? $_POST['potasio'] : NULL,
                trim($_POST["sodio"]) !== '' ? $_POST['sodio'] : NULL,
                trim($_POST["relacion_nak"]) !== '' ? $_POST['relacion_nak'] : NULL,
                trim($_POST["cloro"]) !== '' ? $_POST['cloro'] : NULL,
                trim($_POST["bicarbonato"]) !== '' ? $_POST['bicarbonato'] : NULL,
                trim($_POST['brecha_anionica']) !== '' ? $_POST['brecha_anionica'] : NULL,
                trim($_POST["diferencia_de_iones_fuertes"]) !== '' ? $_POST['diferencia_de_iones_fuertes'] : NULL,
                trim($_POST["osmolalidad"]) !== '' ? $_POST['osmolalidad'] : NULL,
                trim($_POST["amonio"]) !== '' ? $_POST['amonio'] : NULL,
                trim($_POST["tiempo_de_tromboplastina"]) !== '' ? $_POST['tiempo_de_tromboplastina'] : NULL,
                trim($_POST["tiempo_de_protrombina"]) !== '' ? $_POST['tiempo_de_protrombina'] : NULL,
                trim($_POST["t4_libre"]) !== '' ? $_POST['t4_libre'] : NULL,
                $_POST["fk_specie_id"]
            ]);
            header("Location: ../referencias/index.php");
        }
    }

    public function destroy($referencia_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->DESTROY, "i", [$referencia_id]);
            header("Location: ../referencias/index.php");
        }
    }

    public function show($referencia_id)
    {
        $database_controller = new DatabaseController();
        $referencia_result = $database_controller->read($this->SHOW, "i", [$referencia_id]);
        return $referencia_result->fetch_assoc();
    }

    public function options($specie_id)
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->OPTIONS, "i", [$specie_id]);
    }

    public function round($result, $string)
    {
        if (isset($result) && isset($string)) {
            $x = preg_match('/-?\d+(\.\d+)?/', $string, $x) ? $x[0] : '0';
            $precision = strpos($x, '.') !== false ? strlen($x) - strpos($x, '.') - 1 : 0;
            return number_format($result, $precision); 
        }
        return NULL;
    }

    
    public function getSuperscript($string) 
    {
        $string = preg_replace_callback('/\^(\d+)/', function($match) {
            return '<sup>' . $match[1] . '</sup>';
        }, $string);
        return $string;
    }

}

$referencia_controller = new ReferenciaController();
