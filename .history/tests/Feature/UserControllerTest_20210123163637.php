<?php

namespace Tests\Feature;

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
            "date_naissance" => "2001-01-23",
            "email" => "lyeszellag@gmail.com",
            "password" => "abdtifchalal",
        ];
    }
    public function test_can_create_user()
    {
        $this->post(route('users.store'), $this->data)
            ->assertStatus(201)
            ->assertJson($this->data);
    }

    public function test_create_user_with_email_already_exist()
    {
        $this->post(route('users.store'), $this->data)
            ->assertStatus(409)
            ->assertJson(["message" => "Email already exists"]);
    }

    public function test_create_user_with_empty_first_name()
    {
        $this->data['first_name'] = "";
        $this->post(route('users.store'), $this->data)
            ->assertStatus(409)
            ->assertJson(["message" => "First Name is empty"]);
    }

    // public function test_create_user_with_empty_last_name()
    // {
    //     $this->data['last_last'] = "";
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
}
