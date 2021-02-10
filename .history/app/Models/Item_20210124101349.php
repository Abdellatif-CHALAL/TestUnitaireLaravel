<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Item extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'todolist_id',
        'created_at'

    ];



    public function todolist()
    {
        return $this->belongsTo(TodoList::class);
    }


    public function isValid(): bool
    {
        if (empty($this->name))
            throw new Exception('Name is empty');
        if (strlen($this->content) > 1000)
            $details .= " Content must be less than 1000 characters";

        if (
            empty($this->name)
            || strlen($this->content) > 1000
        )
            throw new Exception('Message exception details:' . $details . ' }');
        return true;
    }
}
