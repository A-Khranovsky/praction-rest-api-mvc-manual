<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Type extends Model
{
    private PDO $pdo;
    private array $fields = [
        'id' => 'integer',
        'name' => 'string'
    ];

    public function __construct(Database $db)
    {
        $this->pdo = $db->pdo;
    }

    public function getIdByName(string $name): int
    {
        $sql = "select id from types where name=:name";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':name', $name);
        $result->execute();
        return $result->fetch(Database::FETCH_ASSOC)['id'];
    }

    public function all(): array
    {
        $sql = "select * from types";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(Database::FETCH_ASSOC);
    }
}
