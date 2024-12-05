<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'ticket_number'
    ];



    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }
}
