<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/BreedController.php';
$breed_controller->destroy($_GET['breed_id']);
