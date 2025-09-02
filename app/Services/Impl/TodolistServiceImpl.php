<?php

namespace App\Services\Impl;

use App\Services\TodolistService;

class TodolistServiceImpl implements TodolistService
{

    public function getAll(): array
    {
        return session()->get('todos', []);
    }

    public function create(array $data): array
    {
        $todos = session()->get('todos', []);
        $id = count($todos) + 1;
        $todo = ['id' => $id, 'todo' => $data['todo']];
        $todos[$id] = $todo;
        session()->put('todos', $todos);
        return $todo;
    }

    public function delete(int $id): bool
    {
        $todos = session()->get('todos', []);
        unset($todos[$id]);
        session()->put('todos', $todos);
        return true;
    }
}
