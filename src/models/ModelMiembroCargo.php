<?php

require_once '../src/utils/Sqlite.php';


class ModelMiembroCargo
{
  private int $id;
  private string $fechaInicio;
  private string $fechaFinalizacion;

  private int $miembroId;
  private int $cargoId;

  public function __construct()
  {
    $this->id = 0;
    $this->fechaInicio = "";
    $this->fechaFinalizacion = "";
    $this->miembroId = 0;
    $this->cargoId = 0;
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->fechaInicio = $data["fechaInicio"];
    $this->fechaFinalizacion = $data["fechaFinalizacion"];

    $this->miembroId = $data["miembroId"];
    $this->cargoId = $data["cargoId"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM miembro_cargo;');
  }

  public function crear(): void
  {
    $sqlQuery = "INSERT INTO miembro_cargo (fechaInicio, fechaFinalizacion, miembroId, cargoId)";
    $sqlQuery .= " VALUES ('%s', '%s', '%s', '%s');";

    $sqlQuery = sprintf($sqlQuery, $this->fechaInicio, $this->fechaFinalizacion, $this->miembroId, $this->cargoId);

    Sqlite::execSql($sqlQuery);
  }

  public function editar(): void
  {
    $sqlQuery = "UPDATE miembro_cargo SET fechaInicio='%s', fechaFinalizacion='%s', miembroId='%s', cargoId='%s' WHERE id=%s";

    $sqlQuery = sprintf($sqlQuery, $this->fechaInicio, $this->fechaFinalizacion, $this->miembroId, $this->cargoId, $this->id);

    Sqlite::execSql($sqlQuery);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM miembro_cargo WHERE id=$id");
  }
}
