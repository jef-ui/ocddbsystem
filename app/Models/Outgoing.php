<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $fillable = [

        'subject_description',
        'date',
        'time',
        'sent_via',
        'recipient',
        'type',
        'status',
        'file_path',
        'file_path2',
        
    ];
}
