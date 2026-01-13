<?php

require_once 'SessionController.php';

class PaymentController
{
    public string $INDEX = "CALL SELECT_PAYMENTS(?)";
    public string $STORE = "CALL INSERT_PAYMENT(?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_PAYMENT(?)";
    public string $SUMMARY = "CALL SELECT_PAGINED_PAYMENTS(?, ?, ?)";

    public string $Q;
    public string $PAGE;
    public int $CASES_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->CASES_PER_PAGE = 5;
    }

    public function index($case_id)
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "i", [$case_id]);
    }

    public function store($case_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment'])) {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "dsi", [$_POST["payment"], $_POST["payment_type"], $case_id]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $case_id);
            } else {
                header("Location: ../home/show.php?case_id="  . $case_id);
            }
        }
    }

    public function destroy($payment_id, $case_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->DESTROY, "i", [$payment_id]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $case_id);
            } else {
                header("Location: ../home/show.php?case_id="  . $case_id);
            }
        }
    }

    public function summary()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->SUMMARY, "sii", [$this->Q, $this->PAGE, $this->CASES_PER_PAGE]);
    }

}

$payment_controller = new PaymentController();

