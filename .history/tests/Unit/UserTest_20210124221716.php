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
        $this->user->last_name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Last Name is empty');
        $this->assertTrue($this->user->isValid());
    }
}
