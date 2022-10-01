<?php


namespace App\Controllers;


use App\Config\Database;
use App\Models\Task;

class TasksController extends Controller
{
    private $taskModel = null;

    public function __construct()
    {
        $this->taskModel = new Task();
    }
    public function index()
    {
        return $this->taskModel->index();
    }

    public function create()
    {
        return 'create';
    }

    public function store()
    {
        return 'store';
    }

    public function show()
    {
        return 'show';
    }

    public function edit()
    {
        return 'edit';
    }

    public function update()
    {
        return 'update';
    }

    public function destroy()
    {
        return 'delete';
    }

}