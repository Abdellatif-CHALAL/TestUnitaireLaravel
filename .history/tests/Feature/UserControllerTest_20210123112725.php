<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_create_post()
    {

        $data = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => "2001-01-23",
            "email" => "abdellatifchalal@gmail.com",
            "password" => "abdellatifchalal",
        ];

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
