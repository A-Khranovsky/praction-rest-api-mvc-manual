<?php

namespace App\Models;

use App\Config\Database;
use App\Interfaces\RestApi;

class Task extends Database implements RestApi
{
    private array $fields = [
        'id' => 'integer',
        'description' => 'text',
        'file' => 'string',
        'finish_date' => 'string Y-m-d',
        'urgently' => 'boolean'
    ];
    private Type $type;


    public function __construct()
    {
        parent::__construct();
        $this->type = new Type(); // has many types
    }

    public function index()
    {
        $sql = "select * from tasks;";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(Database::FETCH_ASSOC);
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
