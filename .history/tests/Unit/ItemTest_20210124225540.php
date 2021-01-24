<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use App\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private Item $item;
    public function setUp(): void
    {
        parent::setUp();
        $this->item = new Item([
            'name' => "name of item",
            'content' => "le contenant de item",
        ]);
    }


    public function test_normal_item()
    {
        $this->assertTrue($this->item->isValid());
    }

    public function test_with_empty_name_item()
    {
        $this->item->name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Name is empty');
        $this->assertTrue($this->item->isValid());
    }

    public function test_with_content_more_1000_caracteres_item()
    {
        $this->item->content = Str::random(10001);
        $this->expectException('Exception');
        $this->expectExceptionMessage('Content must be less than 1000 characters');
        $this->assertTrue($this->item->isValid());
    }

    // public function test_with_empty_email_user()
    // {
    //     $this->user->email = "";
    //     $this->expectException('Exception');
    //     $this->expectExceptionMessage('Email is empty');
    //     $this->assertTrue($this->user->isValid());
    // }

    // public function test_with_ivalid_email_user()
    // {
    //     $this->user->email = "@ggmail.com";
    //     $this->expectException('Exception');
    //     $this->expectExceptionMessage('Email is not valide');
    //     $this->assertTrue($this->user->isValid());
    // }

    // public function test_with_birthday_before_13_years_user()
    // {
    //     $this->user->date_naissance = Carbon::now()->subYears(12)->toDateString();
    //     $this->expectException('Exception');
    //     $this->expectExceptionMessage('You must have 13 years or more');
    //     $this->assertTrue($this->user->isValid());
    // }

    // public function test_with_invalid_password_user()
    // {
    //     $this->user->password = "pwd";
    //     $this->expectException('Exception');
    //     $this->expectExceptionMessage('Password must between 8 and 40 caracters');
    //     $this->assertTrue($this->user->isValid());
    // }
}
