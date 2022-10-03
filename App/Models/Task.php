<?php


namespace App\Models;


use App\Config\Database;
use App\Interfaces\RestApi;

class Task extends Database implements RestApi
{
    private int $id;
    private string $description;
    private string $file;
    private string $finish_date;
    private bool $urgently;
    private Type $type;


    public function __construct()
    {
        parent::__construct();
        $this->type = new Type; // has many types
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
        // TODO: Implement store() method.
    }

    public function store($description = null, $file = null, $finishDate = null, $urgently = null, $type = null)
    {
        $sql = "select id from types where name=:type";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':type', $type);
        $result->execute();
        $type_id = $result->fetch(Database::FETCH_ASSOC)['id'];

        $sql = "INSERT INTO tasks (description, file, finish_date, urgently, type_id)
                    VALUES (:description, :file, :finishDate, :urgently, :type_id);";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':description', $description);
        $result->bindParam(':file', $file);
        $result->bindParam(':finishDate', $finishDate);
        $result->bindParam(':urgently', $urgently);
        $result->bindParam(':type_id', $type_id);
        $result->execute();
    }

    public function show($id): array
    {
        $sql = "select * from tasks where id=:id;";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetchAll(Database::FETCH_ASSOC);
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}
