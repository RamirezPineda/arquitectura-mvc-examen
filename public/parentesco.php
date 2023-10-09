<?php

require_once '../src/controllers/ControllerParentesco.php';


$controller = new ControllerParentesco();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $request = [...$_GET];

    $controller->index($request);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'DELETE') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $controller->destroy($id);
    } else {
        echo "No se proporcionó un ID para eliminar.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = [...$_POST];

    $controller->store($request);
}
