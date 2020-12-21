<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;


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
            "name" => "name20",
            "content" => "content20",
            "created_at" => "2020-12-21T15:53:17.000000Z",
        ]);

        $mock = $this->createMock(ToDoListService::class);
        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $mock->expects($this->any())->method('getLastItem')->willReturn($item);



        assertEquals($item, $mock->getLastItem());
        assertEquals(1, $mock->getNumberOfItemsOfUser());
    }
}
