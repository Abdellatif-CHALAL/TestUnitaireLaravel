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
            "name" => "name20",
            "content" => "content20",
            'created_at' => Carbon::now()->addMinutes(-30)
        ]);

        $mock = $this->createMock(ToDoListService::class);
        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $mock->expects($this->any())->method('getLastItem')->willReturn($item);
        $mock->todolist_id = 1;

        // assertEquals($item, $mock->getLastItem());
        // assertEquals(1, $mock->getNumberOfItemsOfUser());
        var_dump($mock->add($item));
    }
}
