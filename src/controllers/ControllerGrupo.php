<?php

require_once '../src/views/ViewGrupo.php';
require_once '../src/models/ModelGrupo.php';

class ControllerGrupo
{

  private ModelGrupo $modelo;
  private ViewGrupo $vista;

  public function __construct()
  {
    $this->modelo = new ModelGrupo();
    $this->vista = new ViewGrupo();
  }

  public function listar(): void
  {
    $grupos = $this->modelo->listar();
    $this->vista->mostrar($grupos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();
    
    $grupos = $this->modelo->listar();
    $this->vista->mostrar($grupos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $grupos = $this->modelo->listar();
    $this->vista->mostrar($grupos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);
    $grupos = $this->modelo->listar();
    $this->vista->mostrar($grupos);
  }
}
