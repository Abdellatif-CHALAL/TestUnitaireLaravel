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
        return Item::where('todolist_id', $this->todolist_id)->first();
    }

    public function getNumberOfItemsOfUser(): int
    {
        return count(Item::where('todolist_id', $this->todolist_id)->get(['id']));
    }


    public function checkPeriodBetweenTwoItems(Item $item): bool
    {
        if (!Carbon::now()->addMinutes(-30)->isAfter($item['created_at'])) {
            throw new Exception("more 30 minutes if you want Add a new item !!");
        }

        return $this->getLastItem()->created_at->diffInMinutes($item->created_at);
        return true;
    }
}
