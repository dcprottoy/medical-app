<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinments extends Model
{
    use HasFactory;
    protected $fillable = [
        'appoint_id',
        'patient_id',
        'doctor_id',
        'appointed_date',
        'note',
        'serial'
    ];

}
