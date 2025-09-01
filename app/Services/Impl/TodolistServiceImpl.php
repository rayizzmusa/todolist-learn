<?php

namespace App\Services\Impl;

use App\Services\TodolistService;

class TodolistServiceImpl implements TodolistService
{
    private array $todos = [];
    private int $nextId = 1;

    public function getAll(): array
    {
        return array_values($this->todos);
    }

    public function create(array $data): array
    {
        $todo = [
            'id' => $this->nextId++,
            'todo' => $data['todo'],
        ];

        $this->todos[$todo['id']] = $todo;
        return $todo;
    }

    public function delete(int $id): bool
    {
        unset($this->todos[$id]);
        return true;
    }
}
