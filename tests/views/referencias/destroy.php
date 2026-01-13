<?php
require_once '../../../controllers/DatabaseController.php';
require_once '../../controllers/ReferenciaController.php';
$referencia_controller->destroy($_GET['referencia_id']);
