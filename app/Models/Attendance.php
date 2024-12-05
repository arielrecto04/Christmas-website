<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'arrival_date',
        // 'ticket_number',
        'employee_id'
    ];



    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
