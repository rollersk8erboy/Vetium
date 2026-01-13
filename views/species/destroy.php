<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/SpecieController.php';
$specie_controller->destroy($_GET['specie_id']);
