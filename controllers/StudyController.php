<?php

require_once 'SessionController.php';

class StudyController
{
    public string $INDEX = "CALL SELECT_PAGINED_STUDIES(?, ?, ?)";
    public string $STORE = "CALL INSERT_STUDY(?, ?, ?)";
    public string $UPDATE = "CALL UPDATE_STUDY(?, ?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_STUDY(?)";
    public string $SHOW = "CALL SELECT_STUDY(?)";
    public string $OPTIONS = "CALL SELECT_STUDIES(?)";

    public string $Q;
    public string $PAGE;
    public int $STUDIES_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->STUDIES_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->STUDIES_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "sss", [$_POST["study"], $_POST["public_price"], $_POST["vet_price"]]);
            header("Location: ../studies/index.php");
        }
    }

    public function update($study_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "isss", [$study_id, $_POST["study"], $_POST["public_price"], $_POST["vet_price"]]);
            header("Location: ../studies/index.php");
        }
    }

    public function destroy($study_id)
    {
        $database_controller = new DatabaseController();
        $database_controller->write($this->DESTROY, "i", [$study_id]);
        header("Location: ../studies/index.php");
    }

    public function show($study_id)
    {
        $database_controller = new DatabaseController();
        $study_result = $database_controller->read($this->SHOW, "i", [$study_id]);
        return $study_result->fetch_assoc();
    }

    public function options($case_id)
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->OPTIONS, "i", [$case_id]);
    }
}

$study_controller = new StudyController();
