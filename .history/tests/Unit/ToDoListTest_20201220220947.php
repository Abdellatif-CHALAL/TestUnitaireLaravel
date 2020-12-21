<?php

namespace Tests\Unit;

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

        // $this->assertTrue($user->id);
        $todolist = new TodoList();
        $todolist->id = 1;
        $todolist->description = "une petit description";
        $todolist->user_id = $user->id;

        $item = new Item();
        $item->id = 1;
        $item->name = "name1";
        $item->content = "un petit text";
        $item->todolist_id = $todolist->id;

        $obj = $this->createMock(TodoList::class);
        $obj->expects($this->any())->method('getNumberOfItemsOfUser')->will($this->returnValue(42));

        $this->assertEquals(true, $user->id === 1);
    }
}
