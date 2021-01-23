<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_create_post()
    {

        $data = [
            "id" => 1,
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => "2001-01-23",
            "email" => "abdellatifchalal44@gmail.com",
            "password" => "abdellatifchalal",
            "created_at" => "2021-01-23T10:21:16.000000Z",
            "updated_at" => "2021-01-23T10:21:16.000000Z"
        ];

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
