<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    public function test_can_create_todolist()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);
    }

    public function test_can_create_todolist_with_empty_first_name_user()
    {
        $user = User::factory()->create();
        $user->first_name = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :First Name is empty"]);
    }

    public function test_can_create_todolist_with_empty_last_name_user()
    {
        $user = User::factory()->create();
        $user->last_name = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :Last Name is empty"]);
    }

    public function test_can_create_todolist_with_empty_email_user()
    {
        $user = User::factory()->create();
        $user->email = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :Email is empty"]);
    }

    public function test_can_create_todolist_with_invalid_email_user()
    {
        $user = User::factory()->create();
        $user->email = "gmail.com";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :Email is not valide"]);
    }

    public function test_can_create_todolist_with_invalid_password_user()
    {
        $user = User::factory()->create();
        $user->password = "gmail.com";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :Password must between 8 and 40 caracters"]);
    }
}
