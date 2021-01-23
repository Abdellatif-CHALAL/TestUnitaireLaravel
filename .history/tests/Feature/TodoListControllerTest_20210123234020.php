<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    public function test_can_create_todolist()
    {
        $user = User::factory()->make();
        $this->post('/api/user/' . $user->id . '/todo_lists', ["description" => $this->faker->realText(10, 40)])
            ->assertStatus(201);
        // ->assertJson([]);
    }

    // public function test_create_user_with_email_already_exist()
    // {
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(409)
    //         ->assertJson(["message" => "Email already exists"]);
    // }

    // public function test_create_user_with_empty_first_name()
    // {
    //     $this->user['email'] = "email@gmail.com";
    //     $this->user['first_name'] = "";
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "First Name is empty"]);
    // }

    // public function test_create_user_with_empty_last_name()
    // {
    //     $this->user['email'] = "email@gmail.com";
    //     $this->user['last_name'] = "";
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Last Name is empty"]);
    // }

    // public function test_create_user_with_empty_email()
    // {
    //     $this->user['email'] = "";
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Email is empty"]);
    // }

    // public function test_create_user_with_invalid_email()
    // {
    //     $this->user['email'] = "gmail.com";
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Email is not valide"]);
    // }

    // public function test_create_user_with_invalid_password()
    // {
    //     $this->user['email'] = "email@gmail.com";
    //     $this->user['password'] = "";
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Password must between 8 and 40 caracters"]);
    // }

    // public function test_create_user_with_invalid_birthday()
    // {
    //     $this->user['email'] = "email@gmail.com";
    //     $this->user['date_naissance'] = Carbon::now()->subYears(12)->toDateString();
    //     $this->post(route('users.store'), $this->user)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "You must have 13 years or more"]);
    // }
}
