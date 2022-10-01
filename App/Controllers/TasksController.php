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

    public function create($description = null, $file = null, $finishDate = null, $urgently = null, $type = null)
    {
        $this->taskModel->create('Іава', '2.jpg', '2020-10-4', true, '');
        return 'created';
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