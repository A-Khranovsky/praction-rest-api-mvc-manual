<?php


namespace App\Interfaces;


interface RestApi
{
    public function index();

    public function create($description= null, $file= null, $finishDate= null, $urgently= null, $type= null);

    public function store();

    public function show();

    public function edit();

    public function update();

    public function destroy();
}