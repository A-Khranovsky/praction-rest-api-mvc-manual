<?php

namespace App\Controllers;

use App\Interfaces\RestApi;
use App\Models\Model;
use App\Models\Task;
use App\Views\Responser;

class TasksController extends Controller implements RestApi
{
    private $model, $responser;

    public function __construct(Responser $responser, Model $model)
    {
        $this->model = $model;
        $this->responser = $responser;
    }

    public function index()
    {
        $this->responser->set([$this->model->index()], 200);
        return $this->responser->response();
    }

    public function create()
    {
        $this->responser->set($this->model->create(), 200);
        return $this->responser->response();
    }

    public function store($queryParams)
    {
        $this->responser->set($this->model->store($queryParams), 201);
        return $this->responser->response();
    }

    public function edit($id)
    {
        $this->responser->set($this->model->edit($id), 200);
        return $this->responser->response();
    }

    public function update($id, $queryParams)
    {
        $this->responser->set($this->model->update($id, $queryParams), 201);
        return $this->responser->response();
    }

    public function destroy($id)
    {
        $this->responser->set($this->model->destroy($id), 201);
        return $this->responser->response();
    }
}
