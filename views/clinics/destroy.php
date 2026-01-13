<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ClinicController.php';
$clinic_controller->destroy($_GET['clinic_id']);
