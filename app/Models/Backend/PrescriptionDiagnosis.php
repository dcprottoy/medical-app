<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'diagnosis_id',
        'diagnosis_value'
    ];
}
