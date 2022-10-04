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
        $this->responser->set($this->taskModel->create(), 200);
        return $this->responser->response();
    }

    public function store($queryParams)
    {
        $this->responser->set($this->taskModel->store($queryParams), 201);
        return $this->responser->response();
    }

    public function edit($id)
    {
        $this->responser->set($this->taskModel->edit($id), 200);
        return $this->responser->response();
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