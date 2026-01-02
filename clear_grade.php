<?php
session_start();

require_once 'controllers/ClearDataController.php';

$controller = new ClearDataController();
$controller->clearGrade();
