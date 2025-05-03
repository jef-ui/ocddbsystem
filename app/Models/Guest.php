<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [

        'date_of_visit',
        'name',
        'agency',
        'position',
        'gender',
        'purpose_of_visit',
        'e_signature',
        
    ];
}
