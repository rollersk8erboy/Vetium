<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/CaseController.php';
$case_controller->destroy($_GET['case_id']);
