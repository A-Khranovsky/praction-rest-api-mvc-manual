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
        // TODO: Implement create() method.
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
