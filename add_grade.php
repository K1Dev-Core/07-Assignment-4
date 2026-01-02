<?php
session_start();

require_once 'controllers/AddGradeController.php';

$controller = new AddGradeController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->add();
} else {
    $controller->index();
}
