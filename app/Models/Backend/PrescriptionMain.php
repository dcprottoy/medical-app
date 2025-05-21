<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMain extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'appoint_id',
        'patient_id',
        'doctor_id',
        'patient_name',
        'patient_gender',
        'patient_age',
        'prescribed_date',
        'created_by',
        'updated_by'
    ];

    public function patient(): HasOne
    {
        return $this->hasOne(Patients::class, 'patient_id', 'patient_id');
    }
}
