<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator as FacadesValidator;

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
        $details = "{";
        if (empty($this->email)) $details .= " Email is empty";
        if (empty($this->first_name)) $details .= " First Name is empty";
        if (empty($this->last_name)) $details .= " Last Name is empty";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $details .= " Email is not valide";

        if (
            empty($this->email)
            || empty($this->last_name)
            || empty($this->first_name)
            || !filter_var($this->email, FILTER_VALIDATE_EMAIL)
        )
            throw new Exception('Message exception deatails:' . $details . ' }');
    }
}

// || $this->date_naissance->addYears(13)->isBefore(Carbon::now()