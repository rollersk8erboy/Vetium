<?php

require_once 'SessionController.php';

class CaseController
{
    public string $INDEX = "CALL SELECT_PAGINED_CASES(?, ?, ?)";
    public string $STORE = "CALL INSERT_CASE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $UPDATE = "CALL UPDATE_CASE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_CASE(?)";
    public string $SHOW = "CALL SELECT_CASE(?)";
    public string $SUMMARY = "CALL SELECT_CASES_SUMMARY(?, ?, ?)";

    public string $Q;
    public string $PAGE;
    public int $CASES_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->CASES_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->CASES_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $case_id = $database_controller->write($this->STORE, "ssssssssiii", [
                $_POST["pet"],
                $_POST["sex"],
                $_POST["age"],
                $_POST["body_condition_score"],
                $_POST["anamnesis"],
                $_POST["treatment"],
                $_POST["price_type"],
                $_POST["invoice"],
                $_POST["fk_breed_id"],
                $_POST["fk_clinic_id"],
                $_SESSION["user_id"]
            ]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $case_id);
            } else {
                header("Location: ../home/show.php?case_id="  . $case_id);
            }
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $case_id = $database_controller->write($this->UPDATE, "isssssssssiii", [
                $_GET['case_id'],
                $_POST["pet"],
                $_POST["sex"],
                $_POST["age"],
                $_POST["body_condition_score"],
                $_POST["anamnesis"],
                $_POST["treatment"],
                $_POST["price_type"],
                $_POST["invoice"],
                $_POST["delivery_status"],
                $_POST["fk_breed_id"],
                $_POST["fk_clinic_id"],
                $_SESSION["user_id"]
            ]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $_GET['case_id']);
            } else {
                header("Location: ../home/show.php?case_id="  . $_GET['case_id']);
            }
        }
    }

    public function destroy($case_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->DESTROY, "i", [$case_id]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/index.php");
            }else{
                header("Location: ../home/index.php");
            }
          
        }
    }

    public function show($case_id)
    {
        $database_controller = new DatabaseController();
        $report_result = $database_controller->read($this->SHOW, "i", [$case_id]);
        return $report_result->fetch_assoc();
    }

    public function summary()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->SUMMARY, "sii", [$this->Q, $this->PAGE, $this->CASES_PER_PAGE]);
    }

}

$case_controller = new CaseController();
