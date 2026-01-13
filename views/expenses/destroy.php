<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ExpenseController.php';
$expense_controller->destroy($_GET['expense_id']);
