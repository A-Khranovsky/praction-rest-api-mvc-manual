<?php


namespace App\Config;


use PDO;
use PDOException;

class Database
{
    protected $pdo = null;
    protected const FETCH_ASSOC = PDO::FETCH_ASSOC;
    private const driver = 'mysql';
    private const host = 'coffee20.mysql.tools';
    private const userName = 'coffee20_khranovskiy';
    private const password = '4k3s6vUNkK5H';
    private const database = 'coffee20_khranovskiy';
    private const port = '3306';


    public function __construct()
    {
        try {
            $this->pdo = new PDO
                ( self::driver. ':' .
                    'host=' . self::host . ';' .
                    'port=' . self::port . ';' .
                    'dbname=' . self::database,
                self::userName,
                self::password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit('Unable connect to the DB '. $e->getMessage());
        }
    }
}