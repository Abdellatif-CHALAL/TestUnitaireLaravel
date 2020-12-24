<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    private $item;
    private $todolist;


    public function setUp(): void
    {
        parent::setUp();
        $this->item = new Item([
            "name" => "name",
            "content" => "content",
            'created_at' => Carbon::now()->subMinutes(1000)
        ]);

        $this->todolist = $this->getMockBuilder(ToDoListService::class)
            ->onlyMethods(['getNumberOfItemsOfUser', 'getLastItem', 'sendEmailToUser', 'saveItemInDataBase'])
            ->getMock();

        $this->todolist->expects($this->any())->method('getLastItem')->willReturn($this->item);
        $this->todolist->expects($this->any())->method('sendEmailToUser')->willReturn(true);
        $this->todolist->expects($this->any())->method('saveItemInDataBase')->willReturn(true);
        $this->todolist->todolist_id = 1;
    }


    public function testAddItemAfter30Minutes()
    {
        $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);

        assertTrue($this->todolist->add($this->item));
    }


    // public function testAddItemAt8thItemToSendEmailToUser()
    // {
    //     $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(8);

    //     assertTrue($this->todolist->add($this->item));
    // }

    // public function testAddItemMore10Items()
    // {

    //     $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(10);
    //     $this->expectException('Exception');
    //     $this->expectExceptionMessage('You have too many items !!');

    //     assertFalse($this->todolist->add($this->item));
    // }
}
