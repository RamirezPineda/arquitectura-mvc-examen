<?php

require_once '../src/controllers/ControllerParentesco.php';


$controller = new ControllerParentesco();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $request = [...$_GET];

    $controller->listar($request);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['_method'])) {
    $request = [...$_POST];

    if ($request['id'] === "0") {
        $controller->crear($request);
    } else {
        $controller->editar($request);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'DELETE') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $controller->eliminar($id);
    } else {
        echo "No se proporcionó un ID para eliminar.";
    }
}