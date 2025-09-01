<?php

namespace App\Services;

interface TodolistService
{
    public function getAll(): array;
    public function create(array $data): array;
    public function delete(int $id): bool;
}
