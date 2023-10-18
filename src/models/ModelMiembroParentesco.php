<?php

require_once '../src/utils/Sqlite.php';


class ModelMiembroParentesco
{
  private int $id;

  private int $miembroId;
  private int $familiarId;
  private int $parentescoId;

  public function __construct()
  {
    $this->id = 0;
    $this->miembroId = 0;
    $this->familiarId = 0;
    $this->parentescoId = 0;

  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;

    $this->miembroId = $data["miembroId"];
    $this->familiarId = $data["familiarId"];
    $this->parentescoId = $data["parentescoId"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM miembro_parentesco;');
  }

  public function crear(): void
  {
    $sqlQuery = "INSERT INTO miembro_parentesco (miembroId, familiarId, parentescoId)";
    $sqlQuery .= " VALUES ('%s', '%s', '%s');";

    $sqlQuery = sprintf($sqlQuery, $this->miembroId, $this->familiarId, $this->parentescoId);

    Sqlite::execSql($sqlQuery);
  }

  public function editar(): void
  {
    $sqlQuery = "UPDATE miembro_parentesco SET miembroId='%s', familiarId='%s', parentescoId='%s' WHERE id=%s";

    $sqlQuery = sprintf($sqlQuery, $this->miembroId, $this->familiarId, $this->parentescoId, $this->id);

    Sqlite::execSql($sqlQuery);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM miembro_parentesco WHERE id=$id");
  }
}
