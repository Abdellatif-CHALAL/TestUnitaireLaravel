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

    public $item;
    public $mock;


    public function testAddItem()
    {
        $item = new Item([
            "name" => "name",
            "content" => "content20",
            'created_at' => Carbon::now()->subMinutes(100)
        ]);


        $mock = $this->getMockBuilder(ToDoListService::class)
            ->onlyMethods(['getNumberOfItemsOfUser', 'getLastItem', 'sendEmailToUser', 'saveItemInDataBase'])
            ->getMock();

        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $mock->expects($this->any())->method('getLastItem')->willReturn($item);
        $mock->expects($this->any())->method('sendEmailToUser')->willReturn(true);
        $mock->expects($this->any())->method('saveItemInDataBase')->willReturn(true);
        $mock->todolist_id = 1;

        assertTrue($mock->add($item));
    }
}
