<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TodoList extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function getLastItem(): Item
    {
        $items =  Item::all()->where('todo_list_id', $this->id);
        if (empty($items)) {
        }
        return $this->items;
    }

    public function getNumberOfItemsOfUser(): int
    {
        return count($this->items);
    }


    public function checkPeriodBetweenTwoItems(Item $item): bool
    {
        if (empty($this->getLastItem())) {
            return true;
        }
        return $this->getLastItem()->created_at->diffInMinutes($item->created_at) < 30;
    }
}
