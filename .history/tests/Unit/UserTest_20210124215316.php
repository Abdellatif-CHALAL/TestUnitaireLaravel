<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    private $user;
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_normal_user()
    {
        $user = User::factory()->create();

        var_dump($user);
        // $this->assertTrue($user->isValid());
    }
}
