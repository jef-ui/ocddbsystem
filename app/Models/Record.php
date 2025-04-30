<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [

        'received_date',
        'received_time',
        'received_via',
        'from_agency_office',
        'type',
        'subject_description',
        'received_acknowledge_by',
        'status_as_of_date',
        'action_taken',
        'concerned_section_personnel',
        'deadline_of_compliance',
        'compliance_status',
        'file_path',
        'file_path1',
        'file_path2',

    ];
}
