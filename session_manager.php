<?php
session_start();

require_once 'controllers/SessionManagerController.php';

$controller = new SessionManagerController();

if (isset($_GET['clear_type']) || ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_type']))) {
    $controller->clearSession();
} else {
    $controller->index();
}
