<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_create_user()
    {

        $data = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => "2001-01-23",
            "email" => "abdellatifchalalfr@gmail.com",
            "password" => "abdellatifchalal",
        ];
        $this->expectException('Exception');
        $this->expectExceptionMessage('The given data was invalid');

        $this->post(route('users.store'), $data)
            ->assertStatus(403)
            ->assertJson($data);
    }
}
