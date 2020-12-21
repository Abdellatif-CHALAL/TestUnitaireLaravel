<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function testAddItem()
    {
        $user = new User();
        $user->id = 1;
        $user->first_name = "Abdellatif";
        $user->last_name = "CHALAL";
        $user->email = "devgmail.com";
        $user->password = "secret123";
        $user->date_naissance = "2007-01-01";

        $this->assertTrue($user->id);
    }
}
