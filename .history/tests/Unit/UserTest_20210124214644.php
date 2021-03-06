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


    public function test_normal_user()
    {
        $user = new User([
            'first_name' => "Abdellatif",
            'last_name' => "CHALAL",
            'email' => "dev@gmail.com",
            'password' => "secret123",
            'date_naissance' => "2007-01-01",
        ]);
        $this->assertTrue($user->isValid());
    }
}
