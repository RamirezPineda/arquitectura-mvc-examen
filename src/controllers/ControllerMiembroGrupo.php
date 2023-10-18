<?php

require_once '../src/views/ViewMiembroGrupo.php';
require_once '../src/models/ModelMiembroGrupo.php';

require_once '../src/models/ModelMiembro.php';
require_once '../src/models/ModelGrupo.php';


class ControllerMiembroGrupo
{

  private ModelMiembroGrupo $modelo;
  private ViewMiembroGrupo $vista;

  private ModelMiembro $modeloMiembro;
  private ModelGrupo $modeloGrupo;

  public function __construct()
  {
    $this->modelo = new ModelMiembroGrupo();
    $this->vista = new ViewMiembroGrupo();

    $this->modeloMiembro = new ModelMiembro();
    $this->modeloGrupo = new ModelGrupo();
  }

  public function listar(): void
  {
    $miembroGrupos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $grupos = $this->modeloGrupo->listar();

    $this->vista->mostrar($miembroGrupos, $miembros, $grupos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();

    $miembroGrupos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $grupos = $this->modeloGrupo->listar();

    $this->vista->mostrar($miembroGrupos, $miembros, $grupos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $miembroGrupos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $grupos = $this->modeloGrupo->listar();

    $this->vista->mostrar($miembroGrupos, $miembros, $grupos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);

    $miembroGrupos = $this->modelo->listar();
    $miembros = $this->modeloMiembro->listar();
    $grupos = $this->modeloGrupo->listar();

    $this->vista->mostrar($miembroGrupos, $miembros, $grupos);
  }
}
