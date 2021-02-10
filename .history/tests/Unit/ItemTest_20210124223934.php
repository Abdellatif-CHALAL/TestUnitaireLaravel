<?php

namespace Tests\Unit;

use App\Models\Item;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private Item $item;
    public function setUp(): void
    {
        parent::setUp();
        $this->item = new Item([
            'name' => "name of item",
            'content' => "le contenant de item",
            "date_naissance" => Carbon::now()->subYears(13)->toDateString(),
            'email' => "test@gmail.com",
            'password' => 'password',

        ]);
    }


    public function test_normal_user()
    {
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_empty_first_name_user()
    {
        $this->user->first_name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('First Name is empty');
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_empty_last_name_user()
    {
        $this->user->last_name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Last Name is empty');
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_empty_email_user()
    {
        $this->user->email = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Email is empty');
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_ivalid_email_user()
    {
        $this->user->email = "@ggmail.com";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Email is not valide');
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_birthday_before_13_years_user()
    {
        $this->user->date_naissance = Carbon::now()->subYears(12)->toDateString();
        $this->expectException('Exception');
        $this->expectExceptionMessage('You must have 13 years or more');
        $this->assertTrue($this->user->isValid());
    }

    public function test_with_invalid_password_user()
    {
        $this->user->password = "pwd";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Password must between 8 and 40 caracters');
        $this->assertTrue($this->user->isValid());
    }
}
