<?php

require_once '../src/utils/Sqlite.php';


class ModelGrupo
{
  private int $id;
  private string $nombre;
  private string $descripcion;

  public function __construct()
  {
    $this->id = 0;
    $this->nombre = "";
    $this->descripcion = "";
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->nombre = $data["nombre"];
    $this->descripcion = $data["descripcion"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM grupo;');
  }

  public function crear(): void
  {
    $sqlQueryInsert = "INSERT INTO grupo (nombre, descripcion)";
    $sqlQueryInsert .= " VALUES ('%s', '%s');";

    $sqlQueryInsert = sprintf($sqlQueryInsert, $this->nombre, $this->descripcion);

    Sqlite::execSql($sqlQueryInsert);
  }

  public function editar(): void
  {
    $sqlQueryUpdate = "UPDATE grupo SET nombre='%s', descripcion='%s' WHERE id=%s";

    $sqlQueryUpdate = sprintf($sqlQueryUpdate, $this->nombre, $this->descripcion, $this->id);

    Sqlite::execSql($sqlQueryUpdate);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM grupo WHERE id=$id");
  }
}
