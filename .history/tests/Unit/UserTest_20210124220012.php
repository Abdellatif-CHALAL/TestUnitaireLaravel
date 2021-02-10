<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }


    public function test_normal_user()
    {
        $user = User::factory()->make();
        $this->assertTrue($user->isValid());
    }
}
