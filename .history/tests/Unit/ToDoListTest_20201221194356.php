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
            'created_at' => Carbon::now()->addMinutes(30)
        ]);

        $user = new User([
            'first_name' => "Abdellatif",
            'last_name' => "CHALAL",
            'email' => "dev@gmail.com",
            'password' => "secret123",
            'date_naissance' => "2007-01-01",
        ]);

        $mock = $this->getMockBuilder(ToDoListService::class)
            ->onlyMethods(['getNumberOfItemsOfUser', 'getLastItem', 'saveItemInDataBase', 'saveItemInDataBase'])
            ->getMock();

        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(8);
        $mock->expects($this->any())->method('getLastItem')->willReturn($item);
        $mock->expects($this->any())->method('saveItemInDataBase')->willReturn(true);
        $mock->expects($this->any())->method('saveItemInDataBase')->willReturn(true);
        $mock->todolist_id = 1;

        assertTrue(!is_null($item));
        assertTrue($mock->add($item));
    }
}
