
<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;

class PostTest extends TestCase
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
