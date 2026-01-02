<?php
session_start();

require_once 'controllers/DeleteCourseController.php';

$controller = new DeleteCourseController();
$controller->delete();
