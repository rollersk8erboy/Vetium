<?php

require_once 'SessionController.php';

class ItemController
{
    public string $INDEX = "CALL SELECT_ITEMS(?)";
    public string $STORE = "CALL INSERT_ITEM(?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_ITEM(?)";
    public string $SHOW = "CALL SELECT_ITEM(?)";

    public string $Q;
    public string $PAGE;
    public int $ITEMS_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->ITEMS_PER_PAGE = 5;
    }

    public function index($case_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            return $database_controller->read($this->INDEX, "i", [$case_id]);
        }
    }

    public function store($case_id, $clinic_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fk_study_id'])) {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "iii", [$case_id, $clinic_id, $_POST["fk_study_id"]]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $case_id);
            } else {
                header("Location: ../home/show.php?case_id="  . $case_id);
            }
        }
    }

    public function destroy($item_id, $case_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->DESTROY, "i", [$item_id]);
            if (strpos($_SERVER['REQUEST_URI'], '/archive/')) {
                header("Location: ../archive/show.php?case_id="  . $case_id);
            } else {
                header("Location: ../home/show.php?case_id="  . $case_id);
            }
        }
    }

    public function show($item_id)
    {
        $database_controller = new DatabaseController();
        $expense_result = $database_controller->read($this->SHOW, "i", [$item_id]);
        return $expense_result->fetch_assoc();
    }
}

$item_controller = new ItemController();
