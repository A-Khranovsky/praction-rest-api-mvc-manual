<?php

namespace App\Controllers;

use App\Interfaces\RestApi;
use App\Models\Model;
use App\Models\Task;
use App\Views\Responser;

class TasksController extends Controller implements RestApi
{
    private Model $model;
    private Responser $responser;

    public function __construct(Responser $responser, Model $model)
    {
        $this->model = $model;
        $this->responser = $responser;
    }

    public function index(): string|null
    {
        $this->responser->set([$this->model->index()], 200);
        return $this->responser->response();
    }

    public function create(): array|string
    {
        $this->responser->set($this->model->create(), 200);
        return $this->responser->response();
    }

    public function store(array $queryParams): ?string
    {
        $this->responser->set($this->model->store($queryParams), 201);
        return $this->responser->response();
    }

    public function edit(int $id): ?string
    {
        $this->responser->set($this->model->edit($id), 200);
        return $this->responser->response();
    }

    public function update(int $id, array $queryParams): ?string
    {
        $this->responser->set($this->model->update($id, $queryParams), 201);
        return $this->responser->response();
    }

    public function destroy(int $id): ?string
    {
        $this->responser->set($this->model->destroy($id), 201);
        return $this->responser->response();
    }
}
