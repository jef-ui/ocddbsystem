<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OcdDirectory extends Model
{
    use HasFactory;

    protected $fillable = [

         'agency',
         'regionaldirector',
         'designation',
         'hotline',  
         'govmail',
         'address',

    ];
}
