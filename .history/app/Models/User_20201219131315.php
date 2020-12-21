<?php

namespace App\Models;


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

    public function isValid()
    {
        public function isValid()
        {
            return !empty($this->email)
                && !empty($this->lname)
                && !empty($this->fname)
                && filter_var($this->email, FILTER_VALIDATE_EMAIL)
                && $this->birthday->addYears(13)->isBefore(Carbon::now());
        }


    }
}
