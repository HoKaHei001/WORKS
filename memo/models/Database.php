<?php

class Database
{
    public static function getPdo(): PDO
    {
        return new PDO(
            'mysql:charset=UTF8;dbname=LAA1501474-memo;
                host=mysql214.phy.lolipop.lan',
            'LAA1501474',
            'hi060462217'
        );
    }
}
