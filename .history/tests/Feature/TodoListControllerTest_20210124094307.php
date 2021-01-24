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

    public function test_can_create_todolist_with_first_name_user_empty()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);
    }
}
