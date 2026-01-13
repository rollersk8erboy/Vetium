<?php

require_once 'SessionController.php';

class UserController
{
    public string $INDEX = "CALL SELECT_PAGINED_USERS(?, ?, ?)";
    public string $STORE = "CALL INSERT_USER(?, ?, ?, ?)";
    public string $UPDATE = "CALL UPDATE_USER(?, ?, ?, ?, ?)";
    public string $DESTROY = "CALL DESTROY_USER(?)";
    public string $SHOW = "CALL SELECT_USER(?)";

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
            $database_controller->write($this->STORE, "ssss", [$_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["first_name"], $_POST["last_name"]]);
            header("Location: ../users/index.php");
        }
    }

    public function update($user_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $database_controller->write($this->UPDATE, "issss", [
                $user_id, 
                $_POST["username"], 
                $_POST['password'] !== '' ? password_hash($_POST["password"], PASSWORD_DEFAULT) : NULL,
                $_POST["first_name"], 
                $_POST["last_name"]]);
            header("Location: ../users/index.php");
        }
    }

    public function destroy($user_id)
    {
        $database_controller = new DatabaseController();
        $database_controller->write($this->DESTROY, "i", [$user_id]);
        header("Location: ../users/index.php");
    }

    public function show($user_id)
    {
        $database_controller = new DatabaseController();
        $user_result = $database_controller->read($this->SHOW, "i", [$user_id]);
        return $user_result->fetch_assoc();
    }
}

$user_controller = new UserController();
