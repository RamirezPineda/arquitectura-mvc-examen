<?php

class DBConnection
{
    private const DB = '../database/database.sqlite';

    public function connection()
    {
        $db = new SQLite3(self::DB);
        self::createTablesIfNotExist($db);        
        return $db;
    }

    public function execSqlSelect(SQLite3 $db, string $sql): array
    {
        $result = $db->query($sql);

        $models = [];
        while ($data = $result->fetchArray(1)) {
            array_push($models, $data);
        }

        return $models;
    }

    // public static function execSql(string $sql): bool
    // {
    //     $db = new SQLite3(self::DB);
    //     return $db->exec($sql);
    // }

    private function createTablesIfNotExist(SQLite3 $db)
    {
        $db->exec('CREATE TABLE IF NOT EXISTS "miembro" (
            "id"	        INTEGER UNIQUE,
            "ci"	        TEXT,
            "nombre"	    TEXT,
            "telefono"	    INTEGER,
            "edad"	        INTEGER,
            "fechaIngreso"	TEXT,
            PRIMARY KEY("id" AUTOINCREMENT)
        );');
        $db->exec('CREATE TABLE IF NOT EXISTS "cargo" (
            "id"	INTEGER UNIQUE,
            "nombre"	TEXT,
            "descripcion"	TEXT,
            PRIMARY KEY("id" AUTOINCREMENT)
        );');
        $db->exec('CREATE TABLE IF NOT EXISTS "miembro_cargo" (
            "id"	            INTEGER UNIQUE,
            "fechaInicio"	    TEXT,
            "fechaFinalizacion"	TEXT,
            "miembroId"	        INTEGER,
            "cargoId"	        INTEGER,
            FOREIGN KEY("cargoId") REFERENCES "cargo"("id"),
            PRIMARY KEY("id" AUTOINCREMENT),
            FOREIGN KEY("miembroId") REFERENCES "miembro"("id")
        );');

        // $db->exec('');

        // var_dump($result->fetchArray());

        // $db->close();
    }
}
