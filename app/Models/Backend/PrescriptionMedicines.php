<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicines extends Model
{
    use HasFactory;
    
    protected   $fillable = [
        'prescription_id',
        'medicine_id',
        'medicine',
        'dose_id',
        'dose',
        'dose_duration_id',
        'dose_duration',
        'usage_id',
        'usage'
    ];
}
