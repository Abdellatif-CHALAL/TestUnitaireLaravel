<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

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
        $this->todolist->expects($this->any())->method('checkPeriodBetweenTwoItems')->willReturn(true);
        $this->todolist->user = $this->user;
    }


    public function testAddItemAfter30Minutes()
    {
        $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        var_dump($this->todolist->user);
        // assertTrue($this->todolist->add($this->todolist->user, $this->item));
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
