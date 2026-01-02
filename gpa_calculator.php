<?php
session_start();

require_once 'controllers/GPACalculatorController.php';

$controller = new GPACalculatorController();
$controller->index();
