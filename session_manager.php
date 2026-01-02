<?php
session_start();

require_once 'controllers/SessionManagerController.php';

$controller = new SessionManagerController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->clearSession();
} else {
    $controller->index();
}
