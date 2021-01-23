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
            "email" => "abdellatifcha@gmail.com",
            "password" => "abdellatifchalal",
        ];
    }
    public function test_can_create_user()
    {


        // $this->expectException('Exception');
        // $this->expectExceptionMessage('The given data was invalid');

        $this->post(route('users.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
