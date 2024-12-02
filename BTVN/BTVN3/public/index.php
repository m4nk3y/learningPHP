
<?php

require_once '../config/database.php';
require_once '../controllers/ProductController.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../controllers/ProductController.php';

$controller = new ProductController();
$action = $_GET['action'] ?? 'index';

if ($action == 'create') {
    $controller->create();
} elseif ($action == 'store') {
    $controller->store();
} elseif ($action == 'edit') {
    $id = $_GET['id'];
    $controller->edit($id);
} elseif ($action == 'update') {
    $id = $_GET['id'];
    $controller->update($id);
} elseif ($action == 'delete') {
    $id = $_GET['id'];
    $controller->delete($id);
} else {
    $controller->index();
}
