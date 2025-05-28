<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainingdb extends Model
{
    use HasFactory;

    protected $fillable = [

            'training_title',
            'ims_number',
            'training_type',
            'province',
            'municipality',
            'sector',
            'funding',
            'date_from',
            'date_until',
            'venue',
            'number_graduates',
            'number_participation',
            'ocd_personnel',
            'file_path',
            'file_path1',
    ];
}
