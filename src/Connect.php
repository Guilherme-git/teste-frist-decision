<?php

namespace src;
use PDO;
use PDOException;

class Connect
{
    private const HOST = "localhost";
    private const USER = "postgres";
    private const DBNAME = "first_decision";
    private const PASSWORD = "123";
    private const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    private static $instance;

    public static function getInstance(): PDO
    {

        if(empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "pgsql:host=".self::HOST.";port=5432;dbname=".self::DBNAME,
                    self::USER,
                    self::PASSWORD,
                    self::OPTIONS
                );
            }catch (PDOException $e) {
                echo $e->getMessage();
               // die("error connect database");
            }
        }
        return self::$instance;
    }


    final public function __construct()
    {
    }

    final public function __clone()
    {

    }
}