<?php

class Sqlite
{
    private const DB = '../database/database.sqlite';

    public static function execSqlSelect(string $sql): array
    {
        $db = new SQLite3(self::DB);

        $result = $db->query($sql);

        $models = [];
        while ($data = $result->fetchArray(1)) {
            array_push($models, $data);
        }
        // $db->close();
        return $models;
    }

    public function conecctionDatabase()
    {
        $db = new SQLite3(self::DB);

        $db->exec('CREATE TABLE "miembro" (
            "id"	        INTEGER UNIQUE,
            "ci"	        TEXT,
            "nombre"	    TEXT,
            "telefono"	    INTEGER,
            "edad"	        INTEGER,
            "fechaIngreso"	TEXT,
            PRIMARY KEY("id" AUTOINCREMENT)
        );');
        $db->exec('CREATE TABLE "cargo" (
            "id"	INTEGER UNIQUE,
            "nombre"	TEXT,
            "descripcion"	TEXT,
            PRIMARY KEY("id" AUTOINCREMENT)
        );');
        $db->exec('CREATE TABLE "miembro_cargo" (
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

        $db->close();
    }

    public static function execSql(string $sql): bool
    {
        $db = new SQLite3(self::DB);
        return $db->exec($sql);
    }
}
