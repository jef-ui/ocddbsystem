<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisAdminCard extends Model
{
    use HasFactory;

    protected $fillable = [

        'fund_cluster',
        'date',
        'name',
        'position',
        'division',
        'office_agency',
        'unit',
        'description',
        'quantity',
        'amount_utilized',
        'balance',
        'invoice_number',
        'plate_number',
        'type_car',
        'purpose',
        'file_path',
        

    ];
}
