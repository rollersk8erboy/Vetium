<?php

require_once 'SessionController.php';

class SpecieController
{
    public string $INDEX = "CALL SELECT_PAGINED_SPECIES(?, ?, ?)";
    public string $STORE = "CALL INSERT_SPECIE(?)";
    public string $UPDATE = "CALL UPDATE_SPECIE(?, ?)";
    public string $DESTROY = "CALL DESTROY_SPECIE(?)";
    public string $SHOW = "CALL SELECT_SPECIE(?)";
    public string $OPTIONS = "CALL SELECT_SPECIES()";

    public string $Q;
    public string $PAGE;
    public int $SPECIES_PER_PAGE;

    public function __construct()
    {
        $this->Q = isset($_GET['q']) ? $_GET['q'] : '';
        $this->PAGE = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->SPECIES_PER_PAGE = 5;
    }

    public function index()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->INDEX, "sii", [$this->Q, $this->PAGE, $this->SPECIES_PER_PAGE]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->STORE, "s", [$_POST["specie"]]);
            header("Location: ../species/index.php");
        }
    }

    public function update($specie_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "is", [$specie_id, $_POST["specie"]]);
            header("Location: ../species/index.php");
        }
    }

    public function destroy($specie_id)
    {
        $database_controller = new DatabaseController();
        $database_controller->write($this->DESTROY, "i", [$specie_id]);
        header("Location: ../species/index.php");
    }

    public function show($specie_id)
    {
        $database_controller = new DatabaseController();
        $specie_result = $database_controller->read($this->SHOW, "i", [$specie_id]);
        return $specie_result->fetch_assoc();
    }

    public function options()
    {
        $database_controller = new DatabaseController();
        return $database_controller->read($this->OPTIONS);
    }
}

$specie_controller = new SpecieController();
