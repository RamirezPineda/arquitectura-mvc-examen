<?php

require_once '../src/controllers/ControllerMiembro.php';


$controller = new ControllerMiembro();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $request = [...$_GET];

    // $controller->listar($request);
    $controller->listar();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['_method'])) {
    $request = [...$_POST];

    // echo $request["fechaIngreso"]. " ". $request["id"]. " ". $request["nombre"];

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
