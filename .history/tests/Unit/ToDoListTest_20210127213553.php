<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    private Item $item;
    private TodoList $todolist;
    private User $user;
    private ToDoListService $todoListservice;

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
            'created_at' => Carbon::now()->subMinutes(30)
        ]);

        $this->todolist = $this->getMockBuilder(TodoList::class)
            ->onlyMethods(['getNumberOfItemsOfUser', 'checkPeriodBetweenTwoItems'])
            ->getMock();
        $this->todolist->user = $this->user;

        $this->todoListservice = $this->getMockBuilder(ToDoListService::class)
            ->onlyMethods(['addToDatabase', 'sendEmail'])
            ->getMock();
        $this->todoListservice->expects($this->any())->method('sendEmail')->willReturn(true);
        $this->todoListservice->expects($this->any())->method('addToDatabase')->willReturn($this->item);
    }


    public function testAddItemAfter30Minutes()
    {
        $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(false);
        assertEquals($this->item, $this->todolistservice->add($this->todolist->user, $this->item));
    }


    //     public function testAddItemAt8thItemToSendEmailToUser()
    //     {
    //         $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(8);

    //         assertTrue($this->todolist->add($this->item));
    //     }

    //     public function testAddItemMore10Items()
    //     {

    //         $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(10);
    //         $this->expectException('Exception');
    //         $this->expectExceptionMessage('You have too many items !!');

    //         assertTrue($this->todolist->add($this->item));
    //     }
}
