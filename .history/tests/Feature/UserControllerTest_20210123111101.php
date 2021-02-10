
<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_can_create_post()
    {

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
