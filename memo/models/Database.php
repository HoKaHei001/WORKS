<?php

class Database
{
    public static function getPdo(): PDO
    {
        return new PDO(
            'mysql:charset=UTF8;dbname=ph16_memo;
                host=localhost',
            'root',
            'root'
        );
    }
}
