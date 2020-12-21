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
    public function testUserIsValid()
    {
        $user = new User([
            'first_name' => "Abdellatif",
            'last_name' => "CHALAL",
            'email' => "dev@gmail.com",
            'password' => "secret123",
            'date_naissance' => "2007-01-01",
        ]);
        var_dump($user);
        $this->assertTrue($user->isValid());
    }
}
