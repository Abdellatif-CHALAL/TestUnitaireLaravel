<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_create_post()
    {

        $data = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => "2001-01-23",
            "email" => "abdellatif@gmail.com",
            "password" => "abdellatifchalal",
        ];

        $this->post(route('users.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }
}
