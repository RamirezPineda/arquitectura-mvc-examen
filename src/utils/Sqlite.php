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
        return $models;
    }

    public static function execSql(string $sql): bool
    {
        $db = new SQLite3(self::DB);
        return $db->exec($sql);
    }
}
