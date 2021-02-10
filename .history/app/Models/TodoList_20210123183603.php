<?php

namespace App\Models;

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


    public function isValid(): bool
    {
        if (empty($this->description))
            throw new Exception('Description is empty');

        if (empty($this->first_name))
            throw new Exception('First Name is empty');

        if (empty($this->last_name))
            throw new Exception('Last Name is empty');

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            throw new Exception('Email is not valide');

        if (!Carbon::now()->addYears(-13)->isAfter($this->date_naissance))
            throw new Exception('You must have 13 years or more');

        if (!((strlen($this->password)) <= 40 && (strlen($this->password) >= 8)))
            throw new Exception('Password must between 8 and 40 caracters');

        return true;
    }
}
