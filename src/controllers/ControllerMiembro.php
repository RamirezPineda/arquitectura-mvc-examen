<?php

require_once '../src/views/ViewMiembro.php';
require_once '../src/models/ModelMiembro.php';

class ControllerMiembro
{

  private ModelMiembro $modelo;
  private ViewMiembro $vista;

  public function __construct()
  {
    $this->modelo = new ModelMiembro();
    $this->vista = new ViewMiembro();
  }

  public function listar(): void
  {
    $miembros = $this->modelo->listar();
    $this->vista->mostrar($miembros);
  }

  public function crear(array $request)
  {
    $this->modelo->setData($request);
    $this->modelo->crear();

    $miembros = $this->modelo->listar();
    $this->vista->mostrar($miembros);
  }

  public function editar(array $request)
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $miembros = $this->modelo->listar();
    $this->vista->mostrar($miembros);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);

    $miembros = $this->modelo->listar();
    $this->vista->mostrar($miembros);
  }
}
