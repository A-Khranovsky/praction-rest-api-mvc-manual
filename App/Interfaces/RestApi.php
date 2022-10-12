<?php

namespace App\Interfaces;

interface RestApi
{
    public function index(): array|string|null;

    public function create(): array|string;

    public function store(array $queryParams): ?string;

    public function edit(int $id): string|array|null;

    public function update(int $id, array $queryParams): ?string;

    public function destroy(int $id): ?string;
}
