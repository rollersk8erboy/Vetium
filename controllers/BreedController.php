<?php

require_once 'SessionController.php';

class BreedController
{
    public string $INDEX = "CALL SELECT_PAGINED_BREEDS(?, ?, ?)";
    public string $STORE = "CALL INSERT_BREED(?, ?)";
    public string $UPDATE = "CALL UPDATE_BREED(?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_BREED(?)";
    public string $SHOW = "CALL SELECT_BREED(?)";
    public string $OPTIONS = "CALL SELECT_BREEDS(?)";

    public string $Q;
    public string $PAGE;
    public int $BREEDS_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->BREEDS_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->BREEDS_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "is", [$_POST['fk_specie_id'], $_POST["breed"]]);
            header("Location: ../breeds/index.php");
        }
    }

    public function update($breed_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "isi", [$breed_id,  $_POST["breed"], $_POST['fk_specie_id']]);
            header("Location: ../breeds/index.php");
        }
    }

    public function destroy($breed_id)
    {
        $database_controller = new DatabaseController();
        $database_controller->write($this->DESTROY, "i", [$breed_id]);
        header("Location: ../breeds/index.php");
    }

    public function show($breed_id)
    {
        $database_controller = new DatabaseController();
        $breed_result = $database_controller->read($this->SHOW, "i", [$breed_id]);
        return $breed_result->fetch_assoc();
    }

    public function options($specie_id)
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->OPTIONS, "i", [$specie_id == NULL ? $_POST["specie_id"] : $specie_id]);
    }
}

$breed_controller = new BreedController();
