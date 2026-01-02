<?php
session_start();

require_once 'controllers/AddCourseController.php';

$controller = new AddCourseController();
$controller->add();
