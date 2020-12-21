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
    // private  $user;
    public  $item;
    // private  $todolistService;
    public $mock;

    // function __construct()
    // {
    //     parent::setUp();

    // $this->user = new User();
    // $this->user->id = 1;
    // $this->user->first_name = "Abdellatif";
    // $this->user->last_name = "CHALAL";
    // $this->user->email = "abdel44@gmail.com";
    // $this->user->password = "secret123";
    // $this->user->date_naissance = "2007-01-01";



    // }

    public function testAddItem()
    {
        $item = new Item();
        $item->name = "name1";
        //  $item->created_at = Carbon::now();
        $this->item->content = "un petit text";

        $mock = $this->createMock(ToDoListService::class);
        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $this->mock->expects($this->any())->method('getLastItem')->willReturn($this->item);

        // $mock = $this->createMock(User::class);
        // $mock->expects($this->once())->method('isValid')->willReturn(false);
        // $this->todolistService = $this->user->id;

        var_dump($mock->getNumberOfItemsOfUser());
        var_dump($mock->getLastItem());
    }
}
