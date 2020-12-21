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
    // private  $user;
    public  $item;
    // private  $todolistService;
    public $mock;

    // function __construct()
    // {
    //     parent::setUp();


    //     // $user = new User([
    //     //     'first_name' => "Abdellatif",
    //     //     'last_name' => "CHALAL",
    //     //     'email' => "dev@gmail.com",
    //     //     'password' => "secret123",
    //     //     'date_naissance' => "2007-01-01",
    //     // ]);



    // }

    public function testAddItem()
    {
        $item = new Item([
            'id' => 1,
            'todolist_id' => 1,
            'name' => "le nom de Item",
            'content' => "content",
            'created_at' => "2020-12-21T15:53:17.000000Z"
        ]);

        $item = null;
        $mock = $this->createMock(ToDoListService::class);
        $mock->expects($this->any())->method('getNumberOfItemsOfUser')->willReturn(1);
        $mock->expects($this->any())->method('getLastItem')->willReturn($item);


        // $mock = $this->createMock(User::class);
        // $mock->expects($this->once())->method('isValid')->willReturn(false);
        // $this->todolistService = $this->user->id;
        var_dump($mock->getLastItem());
        assertEquals(1, $mock->getNumberOfItemsOfUser());
        // assertTrue($mock->add($item));
    }
}
