<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class TodoListStoreItemControllerTest extends TestCase
{
    public function test_can_add_a_first_item_to_todolist()
    {
        $item = [
            "name" => "name of item",
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
            ->assertStatus(201);
    }

    public function test_can_add_second_item_to_todolist()
    {
        $item = [
            "name" => "name of item",
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
            ->assertStatus(201);

        $second_item = [
            "name" => "name of second item ",
            "content" => "descripton of item",
            "created_at" => Carbon::now()->addHour(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $second_item)
            ->assertStatus(201);
    }

    public function test_can_add_item_before_30_minutes()
    {
        $item = [
            "name" => "name of item",
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
            ->assertStatus(201);

        $second_item = [
            "name" => "name of item 2",
            "content" => "descripton of item",
            "created_at" => Carbon::now(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $second_item)
            ->assertStatus(422)
            ->assertJson(["message" => "more 30 minutes if you want add a new item !!"]);
    }

    public function test_can_add_item_with_unique_name()
    {
        $item = [
            "name" => "name of item",
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
            ->assertStatus(201);

        $second_item = [
            "name" => "name of item",
            "content" => "descripton of item",
            "created_at" => Carbon::now()->addHour(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $second_item)
            ->assertStatus(422)
            ->assertJson(["message" => "Name item already exist"]);
    }

    public function test_can_add_item_after_10_items()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        Item::factory()->count(10)->create([
            "todo_list_id" => $user->todolist->id,
        ]);

        $item = [
            "name" => "name of item",
            "content" => "descripton of item",
            "created_at" => Carbon::now()->addHour(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $item)
            ->assertStatus(422)
            ->assertJson(["message" => "You have too many items !!"]);
    }

    public function test_can_add_eight_item_to_send_email_to_user()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        Item::factory()->count(7)->create([
            "todo_list_id" => $user->todolist->id,
        ]);

        $item = [
            "name" => "name of item",
            "content" => "descripton of item",
            "created_at" => Carbon::now()->addHour(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $item)
            ->assertStatus(422)
            ->assertJson(["message" => "Cannot send message without a sender address"]);
    }



    public function test_can_add_item_with_empty_name()
    {
        $user = User::factory()->create();
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "First Name is empty"]);
    }

    public function test_can_create_todolist_with_empty_last_name_user()
    {
        $user = User::factory()->create();
        $user->last_name = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "Last Name is empty"]);
    }

    public function test_can_create_todolist_with_empty_email_user()
    {
        $user = User::factory()->create();
        $user->email = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "Email is empty"]);
    }

    public function test_can_create_todolist_with_invalid_email_user()
    {
        $user = User::factory()->create();
        $user->email = "gmail.com";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "Email is not valide"]);
    }

    public function test_can_create_todolist_with_invalid_password_user()
    {
        $user = User::factory()->create();
        $user->password = "";
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "Password must between 8 and 40 caracters"]);
    }

    public function test_can_create_todolist_with_invalid_birthday_user()
    {
        $user = User::factory()->create();
        $user->date_naissance = Carbon::now()->subYears(12)->toDateString();
        $user->save();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(422)
            ->assertJson(["message" => "You must have 13 years or more"]);
    }
}
