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
        // $user = new User();
        // $user->first_name = "Abdellatif";
        // $user->last_name = "CHALAL";
        // $user->email = "dev@gmail.com";
        // $user->password = "secret123";
        // $user->date_naissance = "2007-01-01";

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
