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
        if (empty($this->content)) $details .= " First Name is empty,";
        if (empty($this->last_name)) $details .= " Last Name is empty,";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $details .= " Email is not valide,";
        if (!Carbon::now()->addYears(-13)->isAfter($this->date_naissance)) {
            $details .= " Birthday is not valide,";
        }
        if (!((strlen($this->password)) <= 40 && (strlen($this->password) >= 8))) $details .= " Password is not between 8 and 40 caracters";

        if (
            empty($this->email)
            || empty($this->last_name)
            || empty($this->first_name)
            || !filter_var($this->email, FILTER_VALIDATE_EMAIL)
            || !Carbon::now()->addYears(-13)->isAfter($this->date_naissance)
            || !((strlen($this->password)) <= 40 && (strlen($this->password) >= 8))
        )
            throw new Exception('Message exception deatails:' . $details . ' }');
        return true;
    }
}
