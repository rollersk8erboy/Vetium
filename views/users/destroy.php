<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/UserController.php';
$user_controller->destroy($_GET['user_id']);
