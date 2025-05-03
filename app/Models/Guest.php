<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'agency',
        'position',
        'gender',
        'purpose_of_visit',
        'e_signature',
        'date_of_visit',
        'date_of_out',

    ];
}
