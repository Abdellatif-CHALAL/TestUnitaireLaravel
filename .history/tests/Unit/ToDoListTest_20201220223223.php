<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function testAddItem()
    {
        $user = new User();
        $user->id = 1;
        $user->first_name = "Abdellatif";
        $user->last_name = "CHALAL";
        $user->email = "abdel44@gmail.com";
        $user->password = "secret123";
        $user->date_naissance = "2007-01-01";

        $item = new Item();
        $item->id = 1;
        $item->name = "name1";
        $item->content = "un petit text";

        $this->todolist = $this->createMock(ToDoListService::class);
        $this->todolist_id = $user->id;
        $this->todolist->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $toDoListService = new ToDoListService();

        $this->assertEquals(true, $toDoListService->add($item));
    }
}
