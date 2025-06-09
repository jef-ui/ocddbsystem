<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $fillable = [

        'date',
        'time',
        'subject_description',
        'sent_via',
        'recipient',
        'type',
        'status',
        'sender',
        'received_by',
        'file_path',
        'file_path2',
        
    ];
}
