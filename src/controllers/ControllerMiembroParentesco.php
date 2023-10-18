<?php

require_once '../src/views/ViewMiembroParentesco.php';
require_once '../src/models/ModelMiembroParentesco.php';

require_once '../src/models/ModelMiembro.php';
require_once '../src/models/ModelParentesco.php';


class ControllerMiembroParentesco
{

  private ModelMiembroParentesco $modelo;
  private ViewMiembroParentesco $vista;

  private ModelMiembro $modeloMiembro;
  private ModelParentesco $modeloParentesco;

  public function __construct()
  {
    $this->modelo = new ModelMiembroParentesco();
    $this->vista = new ViewMiembroParentesco();

    $this->modeloMiembro = new ModelMiembro();
    $this->modeloParentesco = new ModelParentesco();
  }

  public function listar(): void
  {
    $miembroParentescos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $parentescos = $this->modeloParentesco->listar();

    $this->vista->mostrar($miembroParentescos, $miembros, $parentescos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();

    $miembroParentescos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $parentescos = $this->modeloParentesco->listar();

    $this->vista->mostrar($miembroParentescos, $miembros, $parentescos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $miembroParentescos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $parentescos = $this->modeloParentesco->listar();

    $this->vista->mostrar($miembroParentescos, $miembros, $parentescos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);

    $miembroParentescos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $parentescos = $this->modeloParentesco->listar();

    $this->vista->mostrar($miembroParentescos, $miembros, $parentescos);
  }
}
