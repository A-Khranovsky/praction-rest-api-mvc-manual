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

    public function create($description = null, $file = null, $finishDate = null, $urgently = null, $type = null)
    {
//        $sql = "select * from types;";
//        $result = $this->pdo->prepare($sql);
//        $result->execute();

        $sql = "INSERT INTO tasks (description, file, finish_date, urgently, type)
                    VALUES (:description, :file, :finishDate, :urgently, :type);";
        $result = $this->pdo->prepare($sql);
        $type = 'Особисті';
        $result->bindParam(':description', $description);
        $result->bindParam(':file', $file);
        $result->bindParam(':finishDate', $finishDate);
        $result->bindParam(':urgently', $urgently);
        $result->bindParam(':type', $type);
        $result->execute();
    }

    public function store()
    {
        // TODO: Implement store() method.
    }

    public function show()
    {
        // TODO: Implement show() method.
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
