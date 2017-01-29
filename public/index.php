<?php
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'index';
    $action = 'index';
}

if (!isset($_GET['no_layout'])) {
    require_once('views/layout.php');
} else {
    require_once('views/no_layout.php');
}
