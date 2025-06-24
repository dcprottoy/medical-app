<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionOnExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'pressure',
        'temperature',
        'height',
        'weight',
        'bmi'
    ];
}
