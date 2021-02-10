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
        $user = User::factory()->make();
        $user->first_name = "";
        $user->id = 1;
        var_dump($user);
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "422 Unprocessable Entity :First Name is empty"]);
    }
}
