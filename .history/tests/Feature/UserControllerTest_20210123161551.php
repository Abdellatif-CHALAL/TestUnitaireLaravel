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
            "email" => "chalal@gmail.com",
            "password" => "abdelatifchalal",
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
        // $this->expectException('Exception');
        // $this->expectExceptionMessage('Email already exists');

        $this->post(route('users.store'), $this->data)
            ->assertStatus(200)
            ->assertJson("Email already exists");
    }
}
