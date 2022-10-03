<?php


namespace App\Controllers;


use App\Config\Database;
use App\Models\Task;
use App\Views\Responser;

class TasksController extends Controller
{
    private $taskModel, $responser;

    public function __construct()
    {
        $this->taskModel = new Task();
        $this->responser = new Responser();
    }
    public function index()
    {
        $this->responser->set($this->taskModel->index(), 200);
        return $this->responser->response();
    }

    public function create()
    {
        $this->taskModel->create();
        return 'created';
    }

    public function store($queryParams)
    {
        $this->taskModel->store($queryParams);
        return 'stored';
    }

    public function show($id)
    {
        return $this->taskModel->show($id);
    }

    public function edit()
    {
        return 'edit';
    }

    public function update($id, $queryParams)
    {
        $this->taskModel->update($id, $queryParams);
        return 'update';
    }

    public function destroy($id)
    {
        $this->taskModel->destroy($id);
        return 'delete';
    }

}