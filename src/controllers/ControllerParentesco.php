<?php

require_once '../src/views/ViewParentesco.php';
require_once '../src/models/ModelParentesco.php';

class ControllerParentesco
{

  private ModelParentesco $modelo;
  private ViewParentesco $vista;

  public function __construct()
  {
    $this->modelo = new ModelParentesco();
    $this->vista = new ViewParentesco();
  }

  public function listar(): void
  {
    $parentescos = $this->modelo->listar();
    $this->vista->mostrar($parentescos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();
    // self::listar();
    $parentescos = $this->modelo->listar();
    $this->vista->mostrar($parentescos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $parentescos = $this->modelo->listar();
    $this->vista->mostrar($parentescos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);
    $parentescos = $this->modelo->listar();
    $this->vista->mostrar($parentescos);
  }
}
