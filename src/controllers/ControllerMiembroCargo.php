<?php

require_once '../src/views/ViewMiembroCargo.php';
require_once '../src/models/ModelMiembroCargo.php';

require_once '../src/models/ModelMiembro.php';
require_once '../src/models/ModelCargo.php';


class ControllerMiembroCargo
{

  private ModelMiembroCargo $modelo;
  private ViewMiembroCargo $vista;

  private ModelMiembro $modeloMiembro;
  private ModelCargo $modeloCargo;

  public function __construct()
  {
    $this->modelo = new ModelMiembroCargo();
    $this->vista = new ViewMiembroCargo();

    $this->modeloMiembro = new ModelMiembro();
    $this->modeloCargo = new ModelCargo();
  }

  public function listar(): void
  {
    $miembrocargos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $cargos = $this->modeloCargo->listar();

    $this->vista->mostrar($miembrocargos, $miembros, $cargos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();

    $miembrocargos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $cargos = $this->modeloCargo->listar();

    $this->vista->mostrar($miembrocargos, $miembros, $cargos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $miembrocargos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $cargos = $this->modeloCargo->listar();

    $this->vista->mostrar($miembrocargos, $miembros, $cargos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);

    $miembrocargos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $cargos = $this->modeloCargo->listar();

    $this->vista->mostrar($miembrocargos, $miembros, $cargos);
  }
}
