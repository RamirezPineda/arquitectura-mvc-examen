<?php

require_once '../src/utils/Sqlite.php';

class ModelParentesco
{
  private int $id;
  private string $relacion;
  private string $nombre;
  private int $miembroId;

  public function __construct()
  {
    $this->id = 0;
    $this->relacion = "";
    $this->nombre = "";
    $this->miembroId = 0;
  }

  public function setData(array $data): void
  {
    $this->id = $data["id"] ?? 0;
    $this->relacion = $data["relacion"];
    $this->nombre = $data["nombre"];
    $this->miembroId = $data["miembroId"];
  }

  public function index(): array
  {
    return Sqlite::execSqlSelect('SELECT * FROM parentesco;');
  }

  public function store(): array
  {
    $sqlQueryInsert = "INSERT INTO parentesco (relacion, nombre, miembroId)";
    $sqlQueryInsert .= " VALUES ('%s', '%s', '%s');";

    $sqlQueryUpdate = "UPDATE parentesco SET relacion='%s', nombre='%s', miembroId='%s' WHERE id=%s";

    if ($this->id === 0) {
      $sqlQueryInsert = sprintf($sqlQueryInsert, $this->relacion, $this->nombre, $this->miembroId);
    } else {
      $sqlQueryUpdate = sprintf($sqlQueryUpdate, $this->relacion, $this->nombre, $this->miembroId, $this->id);
    }

    $querySql = $this->id  === 0 ? $sqlQueryInsert : $sqlQueryUpdate;

    $result = Sqlite::execSql($querySql);

    if (!$result) return []; // Ocurrio un error al guardar

    return self::index();
    // return $this->id !== 0 ?
    //   $this->find($this->id) :
    //   $this->find($this->ci, 'ci');
  }

  public function destroy(int $id): bool
  {
    return Sqlite::execSql("DELETE FROM parentesco WHERE id=$id");
  }
}
