<?php

require_once '../src/utils/Sqlite.php';
// require_once '../utils/Sqlite.php';


class ModelMiembro
{
  private int $id;
  private string $ci;
  private string $nombre;
  private int $telefono;
  private int $edad;
  private string $fechaIngreso;

  public function __construct()
  {
    $this->id = 0;
    $this->ci = "";
    $this->nombre = "";
    $this->telefono = 0;
    $this->edad = 0;
    $this->fechaIngreso = "";
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->ci = $data["ci"];
    $this->nombre = $data["nombre"];
    $this->telefono = $data["telefono"];
    $this->edad = $data["edad"];
    $this->fechaIngreso = $data["fechaIngreso"];
  }

  public function listar(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM miembro;');
  }

  public function crear()
  {
    $sqlQuery = "INSERT INTO miembro (ci, nombre, telefono, edad, fechaIngreso)";
    $sqlQuery .= " VALUES ('%s', '%s', '%s', '%s', '%s');";
    $sqlQuery = sprintf($sqlQuery, $this->ci, $this->nombre, $this->telefono, $this->edad, $this->fechaIngreso);

    Sqlite::execSql($sqlQuery);
  }

  public function editar()
  {
    $sqlQuery = "UPDATE miembro SET ci='%s', nombre='%s', telefono='%s' , edad='%s', fechaIngreso='%s' WHERE id=%s";
    $sqlQuery = sprintf($sqlQuery, $this->ci, $this->nombre, $this->telefono, $this->edad, $this->fechaIngreso, $this->id);

    Sqlite::execSql($sqlQuery);
  }

  public function eliminar(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM miembro WHERE id=$id");
  }
}
