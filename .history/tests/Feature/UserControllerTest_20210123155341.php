<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->item = new Item([
            "name" => "name",
            "content" => "content",
            'created_at' => Carbon::now()->subMinutes(30)
        ]);
    }
    public function test_can_create_user()
    {

        $data = [
            "first_name" => "abdellatif",
            "last_name" => "chalal",
            "date_naissance" => "2001-01-23",
            "email" => "abdellatifcha@gmail.com",
            "password" => "abdellatifchalal",
        ];
        // $this->expectException('Exception');
        // $this->expectExceptionMessage('The given data was invalid');

        $this->post(route('users.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
