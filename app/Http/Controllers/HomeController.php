<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function home(Request $request): Response|RedirectResponse
    {
        if ($request->session()->exists("user")) {
            $todos = $this->todolistService->getAll();
            return response()->view('home.todolist', [
                'title' => 'Home Page',
                'dash' => 'Todolist'
            ] + compact('todos'));
            // response itu bisa view bisa json
            // return redirect("/todolist");
        } else {
            return redirect("/login");
        }
    }


    public function add(Request $request): Response
    {
        $todoInpt = $request->only('todo');
        if (empty($todoInpt)) {
            $todos = $this->todolistService->getAll();
            return response()->view('home.todolist', [
                "title" => "Home Page",
                "dash" => "Todolist",
                "error" => "masukan todo!",
                "todos" => $todos
            ]);
        }
        $this->todolistService->create($todoInpt);
        $todos = $this->todolistService->getAll();

        return response()->view("home.todolist", [
            "title" => "Home Page",
            "dash" => "Todolist",
            "todos" => $todos
        ]);
    }

    public function destroy(int $id): Response
    {
        $this->todolistService->delete($id);
        $todos = $this->todolistService->getAll();

        return response()->view("home.todolist", [
            "title" => "Home Page",
            "dash" => "Todolist",
            "message" => "berhasil dihapus",
            "todos" => $todos
        ]);
    }
}
