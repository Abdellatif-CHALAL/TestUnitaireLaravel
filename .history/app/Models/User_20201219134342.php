<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public Request $request;

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
        return Request::input('last_name');
    }

    //     return !empty($this->email)
    //         && !empty($this->last_name)
    //         && !empty($this->first_name)
    //         && filter_var($this->email, FILTER_VALIDATE_EMAIL)
    //         && $this->date_naissance->addYears(13)->isBefore(Carbon::now());
    // }
}
