<?php

class DatabaseConnection
{
    private static $connection;
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public static function connect($config)
    {
        self::$connection = new PDO(
            $config['connection'].';dbname='.$config['name'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}
