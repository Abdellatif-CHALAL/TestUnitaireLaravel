<?php

namespace Tests\Unit;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User([
            'first_name' => "abdellatif",
            'last_name' => "chalal",
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

    public function test_with_password_user()
    {
        $this->user->password = "pwd";
        $this->expectException('Exception');
        $this->expectExceptionMessage('You must have 13 years or more');
        $this->assertTrue($this->user->isValid());
    }
}
