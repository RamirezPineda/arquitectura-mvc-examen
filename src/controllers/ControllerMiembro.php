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

  public function store(array $request): void
  {
    $this->modelo->setData($request);
    $miembros = $this->modelo->store();
    $this->vista->mostrar($miembros);
  }

  public function destroy(int $id)
  {
    $this->modelo->destroy($id);
    self::listar();
  }
}
