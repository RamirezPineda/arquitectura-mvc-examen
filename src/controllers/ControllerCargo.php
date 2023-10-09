<?php

require_once '../src/views/ViewCargo.php';
require_once '../src/models/ModelCargo.php';

class ControllerCargo
{

  private ModelCargo $modelo;
  private ViewCargo $vista;

  public function __construct()
  {
    $this->modelo = new ModelCargo();
    $this->vista = new ViewCargo();
  }

  public function listar(): void
  {
    $cargos = $this->modelo->listar();
    $this->vista->mostrar($cargos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();
    // self::listar();
    $cargos = $this->modelo->listar();
    $this->vista->mostrar($cargos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $cargos = $this->modelo->listar();
    $this->vista->mostrar($cargos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);
    $cargos = $this->modelo->listar();
    $this->vista->mostrar($cargos);
  }
}
