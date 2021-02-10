<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_naissance',
        'email',
        'password',
    ];

    public function todolist()
    {
        return $this->hasOne(TodoList::class);
    }

    public function isValid(): bool
    {
        if (empty($this->email))
            throw new Exception('Email is empty');
        return false
        if (empty($this->first_name))
            throw new Exception('First Name is empty');

        if (empty($this->last_name))
            throw new Exception('Last Name is empty');

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            throw new Exception('Email is not valide');

        if (!Carbon::now()->addYears(-13)->isAfter($this->date_naissance))
            throw new Exception('You have less 30 years');

        if (!((strlen($this->password)) <= 40 && (strlen($this->password) >= 8)))
            throw new Exception('Password is not between 8 and 40 caracters');

        return true;
    }
}
