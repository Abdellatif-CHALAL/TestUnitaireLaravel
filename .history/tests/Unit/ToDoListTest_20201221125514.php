<?php

namespace Tests\Unit;

use App\Http\Services\ToDoListService;
use App\Models\Item;
use App\Models\TodoList;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ToDoListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    private User $user;
    private Item $item;
    private ToDoListService $todolistService;

    function __construct()
    {
        parent::setUp();

        $this->user = new User();
        $this->user->id = 1;
        $this->user->first_name = "Abdellatif";
        $this->user->last_name = "CHALAL";
        $this->user->email = "abdel44@gmail.com";
        $this->user->password = "secret123";
        $this->user->date_naissance = "2007-01-01";

        $this->item = new Item();
        $this->item->name = "name1";
        $this->item->content = "un petit text";
        // $item->created_at = Carbon::now();
        $this->item = $item;

        $this->todolistService = $this->createMock(ToDoListService::class);
        $this->todolistService->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->todolistService->expects($this->any())->method('getLastItem')->willReturn($this->item);
    }

    public function testAddItem()
    {

        $this->todolist_id = $this->user->id;


        echo $this->todolist->getLastItem();
        $this->assertEquals(true, $this->todolist->getLastItem());
    }
}
