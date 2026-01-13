<?php

require_once 'SessionController.php';

class ClinicController
{
    public string $INDEX = "CALL SELECT_PAGINED_CLINICS(?, ?, ?)";
    public string $STORE = "CALL INSERT_CLINIC(?, ?, ?, ?, ?)";
    public string $UPDATE = "CALL UPDATE_CLINIC(?, ?, ?, ?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_CLINIC(?)";
    public string $SHOW = "CALL SELECT_CLINIC(?)";
    public string $OPTIONS = "CALL SELECT_CLINICS()";

    public string $Q;
    public string $PAGE;
    public int $CLINICS_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->CLINICS_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->CLINICS_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "sssss", [$_POST["clinic"], $_POST["address"], $_POST["vet"], $_POST["email"], $_POST["phone_number"]]);
            header("Location: ../clinics/index.php");
        }
    }

    public function update($clinic_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "isssss", [$clinic_id, $_POST["clinic"], $_POST["address"], $_POST["vet"], $_POST["email"], $_POST["phone_number"]]);
            header("Location: ../clinics/index.php");
        }
    }

    public function destroy($clinic_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->DESTROY, "i", [$clinic_id]);
            header("Location: ../clinics/index.php");
        }
    }

    public function show($clinic_id)
    {
        $database_controller = new DatabaseController();
        $clinic_result = $database_controller->read($this->SHOW, "i", [$clinic_id]);
        return $clinic_result->fetch_assoc();
    }

    public function options()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->OPTIONS);
    }
}

$clinic_controller = new ClinicController();
