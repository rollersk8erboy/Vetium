<?php

require_once 'SessionController.php';

class ExpenseController
{
    public string $INDEX = "CALL SELECT_PAGINED_EXPENSES(?, ?, ?)";
    public string $STORE = "CALL INSERT_EXPENSE(?, ?)";
    public string $UPDATE = "CALL UPDATE_EXPENSE(?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_EXPENSE(?)";
    public string $SHOW = "CALL SELECT_EXPENSE(?)";
    public string $SUMMARY = "CALL SELECT_EXPENSES_SUMMARY(?, ?)";

    public string $Q;
    public string $PAGE;
    public int $USERS_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->USERS_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->USERS_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "ss", [$_POST["description"], $_POST["amount"]]);
            header("Location: ../expenses/index.php");
        }
    }

    public function update($expense_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "sss", [$expense_id, $_POST["description"], $_POST["amount"]]);
            header("Location: ../expenses/index.php");
        }
    }

    public function destroy($expense_id)
    {
        $database_controller = new DatabaseController();
        $database_controller->write($this->DESTROY, "i", [$expense_id]);
        header("Location: ../expenses/index.php");
    }

    public function show($expense_id)
    {
        $database_controller = new DatabaseController();
        $expense_result = $database_controller->read($this->SHOW, "i", [$expense_id]);
        return $expense_result->fetch_assoc();
    }

    public function summary()
    {
        $database_controller = new DatabaseController();
        $expense_result = $database_controller->read($this->SUMMARY, "ss", [
            isset($_GET['start_date']) ? ($_GET['start_date'] !== '' ? $_GET['start_date'] : NULL) : NULL,
            isset($_GET['end_date']) ? ($_GET['end_date'] !== '' ? $_GET['end_date'] : NULL) : NULL,
        ]);
        return $expense_result->fetch_assoc();
    }
}

$expense_controller = new ExpenseController();
