<?php


namespace App\Interfaces;


interface RestApi
{
    public function index();

    public function create();

    public function store($description= null, $file= null, $finishDate= null, $urgently= null, $type= null);

    public function show($id);

    public function edit();

    public function update();

    public function destroy();
}