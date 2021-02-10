<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
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
        $this->assertDatabaseHas('items', [
            "name" => "name of item",
            "content" => "descripton of item",
            "created_at" => Carbon::now(),
            "todo_list_id" => $user->todolist->id

        ]);
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

        $this->assertDatabaseHas('items', [
            "name" => "name of item",
            "content" => "descripton of item",
            "created_at" => Carbon::now(),
            "todo_list_id" => $user->todolist->id
        ]);

        $second_item = [
            "name" => "name of second item ",
            "content" => "descripton of item",
            "created_at" => Carbon::now()->addHour(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $second_item)
            ->assertStatus(201);

        $this->assertDatabaseHas('items', [
            "name" => "name of second item ",
            "content" => "descripton of item",
            "todo_list_id" => $user->todolist->id
        ]);
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


    public function test_can_add_item_after_10_items()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);

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

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);

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


    public function test_can_add_item_with_empty_name()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);

        $item = [
            "name" => "",
            "content" => "descripton of item",
            "created_at" => Carbon::now(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $item)
            ->assertStatus(422)
            ->assertJson(["message" => "Name is empty"]);
    }




    public function test_can_add_item_with_content_more_1000_caracteres_item()
    {
        $user = User::factory()->create();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => "decription"])
            ->assertStatus(201);

        $this->assertDatabaseHas('todo_lists', [
            "user_id" => $user->id,
            "description" => "decription"
        ]);

        $item = [
            "name" => "name of item",
            "content" => Str::random(10001),
            "created_at" => Carbon::now(),
        ];
        $this->post('/api/todo_lists/' . $user->id . '/item', $item)
            ->assertStatus(422)
            ->assertJson(["message" => "Content must be less than 1000 characters"]);
    }
}
