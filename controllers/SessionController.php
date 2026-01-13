<?php

class SessionController
{
    public string $INDEX = "CALL SELECT_SESSION_USER(?)";

    public function __construct()
    {
        session_start();
        if (strpos($_SERVER['REQUEST_URI'], '/login/') == false) {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /views/login/index.php");
            }
        }else{
            if (isset($_SESSION['user_id'])) {
                header("Location: /views/home/index.php");
            }
        }
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database_controller = new DatabaseController();
            $session_result = $database_controller->read($this->INDEX, "s", [$_POST["username"]]);
            if ($session_result->num_rows > 0) {
                $user = $session_result->fetch_assoc();
                if (password_verify($_POST["password"], $user['password'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    header("Location: /views/home/index.php");
                }
            }
        }
    }
}

$session_controller = new SessionController();
