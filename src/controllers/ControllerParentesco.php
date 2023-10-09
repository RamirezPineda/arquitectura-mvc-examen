<?php

require_once '../src/views/ViewParentesco.php';
require_once '../src/models/ModelParentesco.php';
require_once '../src/models/ModelMiembro.php';


class ControllerParentesco
{

  private ModelParentesco $modelo;
  private ViewParentesco $vista;

  private ModelMiembro $modeloMiembro;


  public function __construct()
  {
    $this->modelo = new ModelParentesco();
    $this->vista = new ViewParentesco();

    $this->modeloMiembro = new ModelMiembro();

  }

  public function index(): void
  {
    $parentescos = $this->modelo->index();
    $miembros = $this->modeloMiembro->index();
    $this->vista->mostrar($parentescos, $miembros);
  }

  public function store(array $request): void
  {
    $this->modelo->setData($request);
    $parentescos = $this->modelo->store();

    $miembros = $this->modeloMiembro->index();

    $this->vista->mostrar($parentescos, $miembros);
  }

  public function destroy(int $id) {
    $this->modelo->destroy($id);
    self::index();
  }

}
