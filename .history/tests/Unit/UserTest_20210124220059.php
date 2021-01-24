<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            "date_naissance" => Carbon::now()->subYears(13)->toDateString(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',

        ];
    }


    public function test_normal_user()
    {
        $user = User::factory()->make();
        $this->assertTrue($user->isValid());
    }
}
