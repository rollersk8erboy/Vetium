<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers//PaymentController.php';
$payment_controller->destroy($_GET['payment_id'], $_GET['case_id']);
