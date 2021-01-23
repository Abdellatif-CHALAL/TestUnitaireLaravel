<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    private $data;
    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => Carbon::now()->subYears(12)->toDateString(),
            "email" => "ladfefjnzdzdfzzejjdl@gmail.com",
            "password" => "abdtifchalal",
        ];
    }
    public function test_can_create_user()
    {
        $this->post(route('users.store'), $this->data)
            ->assertStatus(201)
            ->assertJson($this->data);
    }

    // public function test_create_user_with_email_already_exist()
    // {
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(409)
    //         ->assertJson(["message" => "Email already exists"]);
    // }

    // public function test_create_user_with_empty_first_name()
    // {
    //     $this->data['email'] = "email1@gmail.com";
    //     $this->data['first_name'] = "";
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "First Name is empty"]);
    // }

    // public function test_create_user_with_empty_last_name()
    // {
    //     $this->data['email'] = "email22@gmail.com";
    //     $this->data['last_name'] = "";
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Last Name is empty"]);
    // }

    // public function test_create_user_with_empty_email()
    // {
    //     $this->data['email'] = "";
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Email is empty"]);
    // }

    // public function test_create_user_with_invalid_email()
    // {
    //     $this->data['email'] = "gmail.com";
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Email is not valide"]);
    // }

    // public function test_create_user_with_invalid_password()
    // {
    //     $this->data['email'] = "email123@gmail.com";
    //     $this->data['password'] = "pwd";
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "Password must between 8 and 40 caracters"]);
    // }

    // public function test_create_user_with_invalid_birthday()
    // {
    //     $this->data['email'] = "email1234@gmail.com";
    //     $this->data['date_naissance'] = Carbon::now()->subYears(12);
    //     $this->post(route('users.store'), $this->data)
    //         ->assertStatus(400)
    //         ->assertJson(["message" => "You must have 13 years or more"]);
    // }
}
