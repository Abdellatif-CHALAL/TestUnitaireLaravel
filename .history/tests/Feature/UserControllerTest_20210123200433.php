<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    private $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => Carbon::now()->subYears(13)->toDateString(),
            "email" => "chalallatif@gmail.com",
            "password" => "abdellatichalal",
        ];
    }
    public function test_can_create_user()
    {
        $this->post(route('users.store'), $this->user)
            ->assertStatus(201)
            ->assertJson($this->user);
    }

    public function test_create_user_with_email_already_exist()
    {
        $this->post(route('users.store'), $this->user)
            ->assertStatus(409)
            ->assertJson(["message" => "Email already exists"]);
    }

    public function test_create_user_with_empty_first_name()
    {
        $this->user['email'] = "email1@gmail.com";
        $this->user['first_name'] = "";
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "First Name is empty"]);
    }

    public function test_create_user_with_empty_last_name()
    {
        $this->user['email'] = "email22@gmail.com";
        $this->user['last_name'] = "";
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "Last Name is empty"]);
    }

    public function test_create_user_with_empty_email()
    {
        $this->user['email'] = "";
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "Email is empty"]);
    }

    public function test_create_user_with_invalid_email()
    {
        $this->user['email'] = "gmail.com";
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "Email is not valide"]);
    }

    public function test_create_user_with_invalid_password()
    {
        $this->data['email'] = "email123@gmail.com";
        $this->data['password'] = "";
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "Password must between 8 and 40 caracters"]);
    }

    public function test_create_user_with_invalid_birthday()
    {
        $this->user['email'] = "email1234@gmail.com";
        $this->user['date_naissance'] = Carbon::now()->subYears(12)->toDateString();
        $this->post(route('users.store'), $this->user)
            ->assertStatus(400)
            ->assertJson(["message" => "You must have 13 years or more"]);
    }
}
