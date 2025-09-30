<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this line

class Ldrrmo extends Model
{
    use HasFactory; // Now this will work correctly

    protected $fillable = [
        'agency_name',
        'head_name',
        'office_address',
        'contact_number',
        'alt_contact_number',
        'official_email_add',
        'alt_email_add',
    ];
}
