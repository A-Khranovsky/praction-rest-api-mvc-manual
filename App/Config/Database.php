<?php


namespace App\Config;


use PDO;
use PDOException;

class Database
{
    protected $pdo = null;
    protected const FETCH_ASSOC = PDO::FETCH_ASSOC;
    private const driver = 'mysql';
    private const host = '####';
    private const userName = '####';
    private const password = '####';
    private const database = '####';
    private const port = '3306';
    private const charset = 'utf8';


    public function __construct()
    {
        try {
            $this->pdo = new PDO
                ( self::driver. ':' .
                    'host=' . self::host . ';' .
                    'port=' . self::port . ';' .
                    'dbname=' . self::database . ';' .
                    'charset=' . self::charset,
                self::userName,
                self::password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit('Unable connect to the DB '. $e->getMessage());
        }
    }
}