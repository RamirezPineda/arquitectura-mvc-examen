<?php

require_once '../src/utils/Sqlite.php';


class ModelMiembroGrupo
{
  private int $id;
  private string $rol;
  private string $fechaIngreso;

  private int $miembroId;
  private int $grupoId;

  public function __construct()
  {
    $this->id = 0;
    $this->rol = "";
    $this->fechaIngreso = "";
    $this->miembroId = 0;
    $this->grupoId = 0;
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->rol = $data["rol"];
    $this->fechaIngreso = $data["fechaIngreso"];

    $this->miembroId = $data["miembroId"];
    $this->grupoId = $data["grupoId"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM miembro_grupo;');
  }

  public function crear(): void
  {
    $sqlQuery = "INSERT INTO miembro_grupo (rol, fechaIngreso, miembroId, grupoId)";
    $sqlQuery .= " VALUES ('%s', '%s', '%s', '%s');";

    $sqlQuery = sprintf($sqlQuery, $this->rol, $this->fechaIngreso,  $this->miembroId, $this->grupoId);

    Sqlite::execSql($sqlQuery);
  }

  public function editar(): void
  {
    $sqlQuery = "UPDATE miembro_grupo SET rol='%s', fechaIngreso='%s', miembroId='%s', grupoId='%s' WHERE id=%s";

    $sqlQuery = sprintf($sqlQuery,$this->rol, $this->fechaIngreso,  $this->miembroId, $this->grupoId, $this->id);

    Sqlite::execSql($sqlQuery);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM miembro_grupo WHERE id=$id");
  }
}
