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

  public function __construct()
  {
    $this->id = 0;
    $this->ci = "";
    $this->nombre = "";
    $this->telefono = 0;
    $this->edad = 0;
  }


  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->ci = $data["ci"];
    $this->nombre = $data["nombre"];
    $this->telefono = $data["telefono"];
    $this->edad = $data["edad"];
  }

  public function index(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM miembro;');
  }

  public function store(): array
  {
    $sqlQueryInsert = "INSERT INTO miembro (ci, nombre, telefono, edad)";
    $sqlQueryInsert .= " VALUES ('%s', '%s', '%s', %s);";

    $sqlQueryUpdate = "UPDATE miembro SET ci='%s', nombre='%s', telefono='%s' , edad=%s WHERE id=%s";

    if ($this->id === 0) {
      $sqlQueryInsert = sprintf($sqlQueryInsert, $this->ci, $this->nombre, $this->telefono, $this->edad);
    } else {
      $sqlQueryUpdate = sprintf($sqlQueryUpdate, $this->ci, $this->nombre, $this->telefono, $this->edad);
    }

    $querySql = $this->id  === 0 ? $sqlQueryInsert : $sqlQueryUpdate;

    $result = Sqlite::execSql($querySql);

    if (!$result) return []; // Ocurrio un error al guardar

    return self::index();
    // return $this->id !== 0 ?
    //   $this->find($this->id) :
    //   $this->find($this->ci, 'ci');
  }

  public function find(string $value, string $column = 'id'): array
  {
    return Sqlite::execSqlSelect("SELECT * FROM miembro WHERE $column='$value';");
  }

  public function destroy(int $id): bool
  {
      return Sqlite::execSql("DELETE FROM miembro WHERE id=$id");
  }


}
