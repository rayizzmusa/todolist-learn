<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginMember()
    {
        $this->withSession([
            "user" => "rayhan"
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "rayhan",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "rayhan");
    }

    public function testLoginError()
    {
        $this->post('/login', [
            "user" => "rayhan",
            "password" => "rayhan"
        ])->assertSeeText("Login")->assertSeeText("User atau Password Salah");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "rayhan",
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}
