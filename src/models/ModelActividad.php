<?php

require_once '../src/utils/Sqlite.php';


class ModelActividad
{
  private int $id;
  private string $nombre;
  private string $lugar;
  private string $hora;

  private int $grupoId;

  public function __construct()
  {
    $this->id = 0;
    $this->nombre = "";
    $this->lugar = "";
    $this->hora = "";
    $this->grupoId = 0;
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->nombre = $data["nombre"];
    $this->lugar = $data["lugar"];
    $this->hora = $data["hora"];
    $this->grupoId = $data["grupoId"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM actividad;');
  }

  public function crear(): void
  {
    $sqlQueryInsert = "INSERT INTO actividad (nombre, lugar, hora, grupoId)";
    $sqlQueryInsert .= " VALUES ('%s', '%s', '%s', '%s');";

    $sqlQueryInsert = sprintf($sqlQueryInsert, $this->nombre, $this->lugar, $this->hora, $this->grupoId);

    Sqlite::execSql($sqlQueryInsert);
  }

  public function editar(): void
  {
    $sqlQueryUpdate = "UPDATE actividad SET nombre='%s', lugar='%s', hora='%s', grupoId='%s' WHERE id=%s";

    $sqlQueryUpdate = sprintf($sqlQueryUpdate, $this->nombre, $this->lugar, $this->hora, $this->grupoId, $this->id);

    Sqlite::execSql($sqlQueryUpdate);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM actividad WHERE id=$id");
  }
}
