<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;


class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    private Item $item;
    private User $user;
    private $todoListservice;

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
        $this->item = new Item([
            "name" => "name",
            "content" => "content",
        ]);

        $this->user->todolist = $this->getMockBuilder(TodoList::class)
            ->onlyMethods(['getNumberOfItemsOfUser', 'checkPeriodBetweenTwoItems'])
            ->getMock();


        $this->todoListservice = $this->getMockBuilder(ToDoListService::class)
            ->onlyMethods(['addToDatabase', 'sendEmail', 'checkUniqueItemName'])
            ->getMock();
        $this->todoListservice->expects($this->any())->method('sendEmail')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('addToDatabase')->willReturn($this->item);
    }


    public function test_add_normal_Item()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_first_Item_()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(0);
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_item_after_30_minutes()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(false);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->expectException('Exception');
        $this->expectExceptionMessage('more 30 minutes if you want add a new item !!');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_item_at_8th_item_to_send_email_to_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(7);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_item_more_10_items()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(10);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->expectException('Exception');
        $this->expectExceptionMessage('You have too many items !!');

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_name_already_exist()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(false);

        $this->expectException('Exception');
        $this->expectExceptionMessage('Name item already exist');

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }


    public function test_add_Item_with_empty_name()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->item->name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Name is empty');

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }


    public function test_add_Item_with_unique_name()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->item->name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Name is empty');

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }


    public function test_add_Item_with_more_1000_caracters_content()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->item->content = Str::random(10001);
        $this->expectException('Exception');
        $this->expectExceptionMessage('Content must be less than 1000 characters');

        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_empty_first_name_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->first_name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('First Name is empty');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_empty_last_name_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->last_name = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Last Name is empty');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_empty_email_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->email = "";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Email is empty');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_ivalid_email_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->email = "@ggmail.com";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Email is not valide');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_birthday_before_13_years_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->date_naissance = Carbon::now()->subYears(12)->toDateString();
        $this->expectException('Exception');
        $this->expectExceptionMessage('You must have 13 years or more');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }

    public function test_add_Item_with_invalid_password_user()
    {
        $this->user->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->user->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('checkUniqueItemName')->willReturn(true);

        $this->user->password = "pwd";
        $this->expectException('Exception');
        $this->expectExceptionMessage('Password must between 8 and 40 caracters');
        assertEquals($this->item, $this->todoListservice->add($this->user, $this->item));
    }
}
