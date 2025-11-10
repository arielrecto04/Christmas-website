<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_number',
    ];

    public static function generateTicketNumber(): string
    {
        return 'TICKET-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
