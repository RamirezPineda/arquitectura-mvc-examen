<?php

require_once '../src/views/ViewActividad.php';
require_once '../src/models/ModelActividad.php';

require_once '../src/models/ModelGrupo.php';

class ControllerActividad
{

  private ModelActividad $modelo;
  private ViewActividad $vista;

  private ModelGrupo $modelGrupo;

  public function __construct()
  {
    $this->modelo = new ModelActividad();
    $this->vista = new ViewActividad();

    $this->modelGrupo = new ModelGrupo();
  }

  public function listar(): void
  {
    $actividades = $this->modelo->listar();
    $grupos =  $this->modelGrupo->listar();

    $this->vista->mostrar($actividades, $grupos);
  }

  public function crear(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->crear();

    $actividades = $this->modelo->listar();
    $grupos =  $this->modelGrupo->listar();

    $this->vista->mostrar($actividades, $grupos);
  }

  public function editar(array $request): void
  {
    $this->modelo->setData($request);
    $this->modelo->editar();

    $actividads = $this->modelo->listar();
    $grupos =  $this->modelGrupo->listar();

    $this->vista->mostrar($actividads, $grupos);
  }

  public function eliminar(int $id)
  {
    $this->modelo->eliminar($id);
    $actividads = $this->modelo->listar();
    $grupos =  $this->modelGrupo->listar();
    
    $this->vista->mostrar($actividads, $grupos);
  }
}
