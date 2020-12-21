<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Item extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];




    public function isValid()
    {
        $details = "{";
        if (empty($this->name)) $details .= " Name is empty,";
        if (strlen($this->content) > 1000) $details .= " Content must be less than 1000 characters";


        if (
            !empty($this->email)
            && strlen($this->content) > 1000)        )
            throw new Exception('Message exception deatails:' . $details . ' }');
        return true;
    }
}
