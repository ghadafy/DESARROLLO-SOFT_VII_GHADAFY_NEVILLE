<?php
session_start();
require_once 'config/db.php';
require_once 'views/layout/head.php';
require_once 'controllers/control.php';
require_once 'controllers/usuarioController.php';


$controller = new Control();

if (!isset($_REQUEST['c'])) {
    $controller->index();
} else {
    $action = $_REQUEST['c'];
    call_user_func(array($controller, $action));
}



require_once 'views/layout/footer.php';
