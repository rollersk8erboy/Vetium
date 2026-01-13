<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/ItemController.php';
$item_controller->destroy($_GET['item_id'], $_GET['case_id']);
