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
            return response()->view('home.todolist', ['title' => 'Home Page'] + compact('todos'));
            // return redirect("/todolist");
        } else {
            return redirect("/login");
        }
    }
}
