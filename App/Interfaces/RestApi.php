<?php

namespace App\Interfaces;

interface RestApi
{
    public function index();

    public function create();

    public function store($queryParams);

    public function edit($id);

    public function update($id, $queryParams);

    public function destroy($id);
}
