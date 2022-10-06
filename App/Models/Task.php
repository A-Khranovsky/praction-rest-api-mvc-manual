<?php

namespace App\Models;

use App\Config\Database;
use App\Interfaces\RestApi;

class Task extends Model implements RestApi
{
    private $pdo;
    private array $fields = [
        'id' => 'integer',
        'description' => 'text',
        'file' => 'string',
        'finish_date' => 'string Y-m-d',
        'urgently' => 'boolean'
    ];
    private $type;


    public function __construct($db)
    {
        $this->type = new Type($db); // has many types
        $this->pdo = $db->pdo;
    }

    public function all()
    {
        $sql = "select * from tasks;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(Database::FETCH_ASSOC);
    }

    private function joinAndPaste(Type $type, string $foriegnKeyOfCurrentTb, string $pastedName)
    {
        $idAndNames = [];
        $types = $type->all();
        foreach ($types as $item) {
            $idAndNames[$item['id']] = $item['name'];
        }
        $tasks = $this->all();
        foreach ($tasks as &$item) {
            foreach ($item as $key => $value) {
                if ($key === $foriegnKeyOfCurrentTb) {
                    unset($item[$key]);
                    $item[$pastedName] = $idAndNames[$value];
                }
            }
        }
        return $tasks;
    }

    public function index()
    {
        return $this->joinAndPaste($this->type, 'type_id', 'type');
    }

    public function create()
    {
        return $this->fields;
    }

    public function store($queryParams)
    {
        $type_id = null;
        if (isset($queryParams['type'])) {
            $type_id = $this->type->getIdByName($queryParams['type']);
        }

        $sql = "INSERT INTO tasks (description, file, finish_date, urgently, type_id)
                    VALUES (:description, :file, :finishDate, :urgently, :type_id);";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':description', $queryParams['description']);
        $result->bindParam(':file', $queryParams['file']);
        $result->bindParam(':finishDate', $queryParams['finishDate']);
        $result->bindParam(':urgently', $queryParams['urgently']);
        $result->bindParam(':type_id', $type_id);
        $result->execute();
        return null;
    }

    public function edit($id)
    {
        $sql = "select * from tasks where id=:id;";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetchAll(Database::FETCH_ASSOC);
    }

    public function update($id, $queryParams)
    {

        $type_id = null;
        if (isset($queryParams['type'])) {
            $type_id = $this->type->getIdByName($queryParams['type']);
        }
        $sql = "update tasks set ";
        foreach ($queryParams as $key => $value) {
            if ($key == 'type') {
                continue;
            }
            if ($value === end($queryParams)) {
                $sql .= $key . '=\'' . $value . '\'';
            } else {
                $sql .= $key . '=\'' . $value . '\', ';
            }
        }
        if (!is_null($type_id)) {
            if (count($queryParams) === 1) {
                $sql .= 'type_id=' . $type_id . ' ';
            } else {
                if ($queryParams['type'] === end($queryParams)) {
                    $sql .= 'type_id=' . $type_id . ' ';
                } else {
                    $sql .= ', type_id=' . $type_id . ' ';
                }
            }
        }
        $sql .= " where id=:id;";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return null;
    }

    public function destroy($id)
    {
        $sql = "delete from tasks where id=:id;";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return null;
    }
}
