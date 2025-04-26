<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioLog extends Model
{
    use HasFactory;

    protected $fillable = [

        'received_date',
        'received_time',
        'sender_name',
        'band',
        'mode',
        'signal_strength',
        'receiver_name',
        'notes_remarks',

    ];
}
