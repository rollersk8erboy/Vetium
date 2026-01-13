<?php
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/StudyController.php';
$study = $study_controller->show($_GET['study_id']);
$study_controller->destroy($_GET['study_id']);
