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

    public $request;
    function __construct(Request $request)
    {
        $this->request = $request;
    }

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
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_naissance' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,40'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $rules;
        }

        return !empty($this->email)
            && !empty($this->last_name)
            && !empty($this->first_name)
            && filter_var($this->email, FILTER_VALIDATE_EMAIL)
            && $this->date_naissance->addYears(13)->isBefore(Carbon::now());
    }
}
