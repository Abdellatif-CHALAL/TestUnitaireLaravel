<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class TodoListStoreItemControllerTest extends TestCase
{
    public function test_can_add_item_to_todolist()
    {
        $item = [
            "name" => "",
            "content" => "descripton of item",
            "created_at" => Carbon::now(),
        ];
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);
        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);

        $this->post('/api/todo_lists/' . $user->id . '/item', $item)
            ->assertStatus(422);
    }

    // public function test_can_create_todolist_with_empty_first_name_user()
    // {
    //     $user = User::factory()->create();
    //     $user->first_name = "";
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "First Name is empty"]);
    // }

    // public function test_can_create_todolist_with_empty_last_name_user()
    // {
    //     $user = User::factory()->create();
    //     $user->last_name = "";
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "Last Name is empty"]);
    // }

    // public function test_can_create_todolist_with_empty_email_user()
    // {
    //     $user = User::factory()->create();
    //     $user->email = "";
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "Email is empty"]);
    // }

    // public function test_can_create_todolist_with_invalid_email_user()
    // {
    //     $user = User::factory()->create();
    //     $user->email = "gmail.com";
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "Email is not valide"]);
    // }

    // public function test_can_create_todolist_with_invalid_password_user()
    // {
    //     $user = User::factory()->create();
    //     $user->password = "";
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "Password must between 8 and 40 caracters"]);
    // }

    // public function test_can_create_todolist_with_invalid_birthday_user()
    // {
    //     $user = User::factory()->create();
    //     $user->date_naissance = Carbon::now()->subYears(12)->toDateString();
    //     $user->save();
    //     $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
    //         ->assertStatus(422)
    //         ->assertJson(["message" => "You must have 13 years or more"]);
    // }
}
