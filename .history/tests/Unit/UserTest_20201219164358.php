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
        $user = new User();
        $user->first_name = "";
        $user->last_name = "";
        $user->email = "devgmail.com";
        $user->password = "secr";
        $user->date_naissance = "2008-01-01";
        $this->assertTrue($user->isValid());
    }
}