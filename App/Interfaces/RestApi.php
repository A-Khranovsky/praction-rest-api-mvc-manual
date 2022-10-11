<?php

namespace App\Interfaces;

interface RestApi
{
    public function index();

    public function create();

    public function store(array $queryParams);

    public function edit(int $id);

    public function update(int $id, array $queryParams);

    public function destroy(int $id);
}
