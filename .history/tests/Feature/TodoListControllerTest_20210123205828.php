<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::create([
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => Carbon::now()->subYears(13)->toDateString(),
            "email" => "chalallatif@gmail.com",
            "password" => "abdellatichalal",
        ]);
        // var_dump($this->user);
        $this->post(route('users.store'), $this->user);
    }
    public function test_can_create_todolist()
    {
        // $this->post('/api/user/' . $user->id . '/todo_lists', $this->user);
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
