<?php
session_start();

require_once 'controllers/ManageCoursesController.php';

$controller = new ManageCoursesController();
$controller->index();
